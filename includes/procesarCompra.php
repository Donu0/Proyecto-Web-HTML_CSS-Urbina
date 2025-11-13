<?php
    require 'conexion.php';
    include 'verificarSesion.php';
 
    // Validar que venga el id del sorteo y que se hayan seleccionado números
    if (!isset($_POST['numeros']) || !isset($_POST['idSorteo'])) {
        header("Location: detallesSorteo.php?Sorteo=" . urlencode($fila['idSorteo']) . "'");
        exit;
    }

    $idSorteo = intval($_POST['idSorteo']);
    $numerosSeleccionados = $_POST['numeros'];
    $totalBoletos = count($numerosSeleccionados); //Los números seleccionados por el usuario para comprar

    // Obtener precio del sorteo
    $stmt = $conexion->prepare("SELECT precioBoleto, nombreSorteo FROM sorteo WHERE idSorteo = ?");
    $stmt->bind_param("i", $idSorteo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $sorteo = $resultado->fetch_assoc();
    $stmt->close();

    $precioUnitario = intval($sorteo['precioBoleto']);
    $totalPago = $precioUnitario * $totalBoletos; //El total a pagar
    $nombreSorteo = urlencode($sorteo['nombreSorteo']);

    // Guardar los boletos temporalmente en sesión para usarlos en PDT
    $_SESSION['numeros_seleccionados'] = $numerosSeleccionados;
    $_SESSION['idSorteo_compra'] = $idSorteo;

    // Redirigir al sandbox de PayPal
    $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr"; 
    $paypal_id =  "sortec@correo.com"; 
    // $return_url = "https://sortec.page.gd/includes/confirmacionPDT.php"; para cuando este publicado
    // $cancel_url = "https://sortec.page.gd/detallesSorteo.php?Sorteo=$idSorteo";
    $return_url = "http://localhost/includes/confirmacionPDT.php"; //En XAMPP
    $cancel_url = "http://localhost/detallesSorteo.php?Sorteo=$idSorteo";
    

    // Construir la URL con los parámetros GET, para que todo se mantenga con php
    $query = http_build_query([
        'cmd' => '_xclick',
        'business' => $paypal_id,
        'item_name' => "Compra de boletos - " . $sorteo['nombreSorteo'],
        'amount' => number_format($totalPago, 2, '.', ''),
        'currency_code' => 'MXN',
        'quantity' => 1,
        'return' => $return_url,
        'cancel_return' => $cancel_url,
        'no_shipping' => '1',
        'lc' => 'es_MX',
        'image_url' => 'https://picsum.photos/id/1015/800/300'
    ]);

    // Redirigir al usuario a PayPal con PHP
    header("Location: $paypal_url?$query");
    exit;
?>