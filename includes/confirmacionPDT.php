<?php
    session_start();
    require 'conexion.php';

    // PayPal PDT Identity Token
    $paypal_pdt_token = "Ipd1GKxh4AKP3rFGaLaHYMpg9udBEchkTSeuOB2BZjcfg0O2rBkgZrM-gx0"; 
    $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr"; // Usa sandbox si estás probando

    if (!isset($_GET['tx'])) {
        die("No se recibió el parámetro de transacción (tx).");
    }

    $tx = $_GET['tx'];

    // Verifcar el estado de la transaccion con PayPal
    $query = "cmd=_notify-synch&tx=$tx&at=$paypal_pdt_token";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $paypal_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) {
        die("Error al comunicarse con PayPal.");
    }

    $lines = explode("\n", trim($response));
    if (strcmp($lines[0], "SUCCESS") == 0) {
        // Extraer los valores devueltos por PayPal
        $data = [];
        for ($i = 1; $i < count($lines); $i++) {
            $temp = explode("=", $lines[$i]);
            if (count($temp) == 2) {
                $data[urldecode($temp[0])] = urldecode($temp[1]);
            }
        }

        //Extraer datos relevantes
        $txn_id = $data['txn_id'];
        $payer_email = $data['payer_email'];
        $payment_amount = $data['mc_gross'];
        $item_name = $data['item_name'];
        $payment_status = $data['payment_status'];

        // Prevenir duplicados y doble pago.
        if (isset($_SESSION['last_txn']) && $_SESSION['last_txn'] === $txn_id) {
            header("Location: ../detallesSorteo.php?Sorteo=" . ($_SESSION['idSorteo_compra'] ?? ''));
            exit;
        }

        // Marcar la transaccion como procesada y que ya no se vuelva a hacer.
        $_SESSION['last_txn'] = $txn_id;

        
        $numerosSeleccionados = $_SESSION['numeros_seleccionados'];
        $idSorteo = $_SESSION['idSorteo_compra']; //No puede ser null
        $idUsuario = $_SESSION['idUsuario'] ?? null;

        // Para verificar que la compra se realizó correctamente
        if ($payment_status === 'Completed' && $idSorteo && !empty($numerosSeleccionados)) {
            // Insertar boletos comprados en la base de datos
            $stmt = $conexion->prepare("INSERT INTO boleto (idBoleto, numero, idUsuario, idSorteo) VALUES (?, ?, ?, ?)");
            foreach ($numerosSeleccionados as $num) {
                $idBoleto = rand(0, 10000000);
                $stmt->bind_param("ssss", $idBoleto, $num, $idUsuario, $idSorteo);
                $stmt->execute();
            }
            $stmt->close();

            // Actualizar boletos restantes del sorteo
            $stmt = $conexion->prepare("UPDATE sorteo SET boletosRestantes = boletosRestantes - ? WHERE idSorteo = ?");
            $totalBoletos = count($numerosSeleccionados);
            $stmt->bind_param("ii", $cantidadComprada, $idSorteo);
            $stmt->execute();
            $stmt->close();

            // Redirigir al recibo
            header("Location: generarRecibo.php?txn_id=$txn_id&idSorteo=$idSorteo&total=$payment_amount");
            exit;
        } else {
            echo "La transacción no se completó o faltan datos.";
        }

    } else {
        echo "Error al verificar el pago con PayPal.";
    }
?>
