<?php
    require 'conexion.php';
    include 'verificarSesion.php';

    $paypal_pdt_token = "Ipd1GKxh4AKP3rFGaLaHYMpg9udBEchkTSeuOB2BZjcfg0O2rBkgZrM-gx0";

    // PayPal envía un parámetro GET llamado tx
    if (!isset($_GET['tx'])) {
        header("Location: ../catalogo.php");
        exit;
    }

    $tx = $_GET['tx'];

    // Enviar verificación a PayPal
    $req = "cmd=_notify-synch&tx=$tx&at=$paypal_pdt_token";
    $ch = curl_init("https://www.sandbox.paypal.com/cgi-bin/webscr");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $res = curl_exec($ch);
    curl_close($ch);

    if (!$res) {
        echo "<h3>Error al verificar la transacción con PayPal.</h3>";
        exit;
    }

    // Verificar respuesta
    $lines = explode("\n", trim($res));
    if (strcmp($lines[0], "SUCCESS") != 0) {
        echo "<h3>Transacción no válida.</h3>";
        exit;
    }

    // Si la transacción fue válida
    $idSorteo = $_SESSION['idSorteo_compra'];
    $numerosSeleccionados = $_SESSION['numeros_seleccionados'];

    // Si el usuario tiene sesión, usamos su idUusario; si no, ponemos null para bolbetos comprados sin registro
    $idUsuario = $sesion_activa ? $_SESSION['idUsuario'] : null;

    // Insertar boletos y actualizar el sorteo
    $stmt = $conexion->prepare("SELECT boletosRestantes FROM Sorteo WHERE idSorteo = ?");
    $stmt->bind_param("i", $idSorteo);
    $stmt->execute();
    $res = $stmt->get_result();

    $sorteo = $res->fetch_assoc();
    $boletosRestantes = intval($sorteo['boletosRestantes']);
    $stmt->close();

    $totalComprados = count($numerosSeleccionados);
    $nuevosRestantes = $boletosRestantes - $totalComprados;

    $stmtInsert = $conexion->prepare("INSERT INTO Boleto (idBoleto, numero, idUsuario, idSorteo) VALUES (?, ?, ?, ?)");
    foreach ($numerosSeleccionados as $num) {
        $idBoleto = rand(0, 10000000);
        $num = intval($num);
        $stmtInsert->bind_param("ssss", $idBoleto, $num, $idUsuario, $idSorteo);
            
        $stmtInsert->execute();
    }
    $stmtInsert->close();

    $stmtUpdate = $conexion->prepare("UPDATE Sorteo SET boletosRestantes = ? WHERE idSorteo = ?");
    $stmtUpdate->bind_param("ii", $nuevosRestantes, $idSorteo);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    unset($_SESSION['numeros_seleccionados']);
    unset($_SESSION['idSorteo_compra']);

    //Para que redirija al detalle del sorteo después de la compra
    header("Location: ../detallesSorteo.php?Sorteo=$idSorteo");
    exit;
?>
