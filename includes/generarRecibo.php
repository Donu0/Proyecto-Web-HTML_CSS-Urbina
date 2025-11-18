<?php
    require('fpdf/fpdf.php');
    require('conexion.php');
    session_start();

    // Verificar que lleguen los datos de la compra, por si acaso
    if (!isset($_GET['txn_id'])) {
        die("No se recibió información de la compra.");
    }

    $txn_id = $_GET['txn_id']; // ID de transacción PayPal
    $idSorteo = $_GET['idSorteo'] ?? '';
    $numerosComprados = explode(",", $_GET['numeros'] ?? ''); //¿Por qué PHP?
    $total = $_GET['total'] ?? '0.00';

    // Obtener datos del sorteo
    $stmt = $conexion->prepare("SELECT nombreSorteo, fechaJuego, organizador FROM sorteo WHERE idSorteo = ?");
    $stmt->bind_param("i", $idSorteo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("No se encontró el sorteo.");
    }

    $sorteo = $result->fetch_assoc();
    $stmt->close();

    // Obtener boletos comprados (Al comprarse se forman, entonces si existen) y los ordena ascendentes por número
    $stmt = $conexion->prepare("SELECT numero FROM boleto WHERE idSorteo = ? AND idCompra = ? ORDER BY numero");
    $idUsuario = $_SESSION['idUsuario'] ?? 'No registrado';
	$idCompra = $txn_id;
    $stmt->bind_param("is", $idSorteo, $idCompra);
    $stmt->execute();
    $res = $stmt->get_result();

    $boletos = [];
    while ($fila = $res->fetch_assoc()) {
        $boletos[] = $fila['numero'];
    }
    $stmt->close();

    // Crear PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);

    // Encabezado
    $pdf->Cell(0,10,'Recibo de Compra - Sortec',0,1,'C');
    $pdf->Ln(10);

    // Información general
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,10,"ID de Transaccion: $txn_id",0,1);
    $pdf->Cell(0,10,"Usuario: $idUsuario",0,1);
    $pdf->Cell(0,10,"Sorteo: {$sorteo['nombreSorteo']}",0,1);
    $pdf->Cell(0,10,"Fecha del sorteo: {$sorteo['fechaJuego']}",0,1);
    $pdf->Cell(0,10,"Organizador: {$sorteo['organizador']}",0,1);
    $pdf->Cell(0,10,"Total pagado: $".$total." MXN",0,1);
    $pdf->Ln(10);

    // Boletos comprados
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,10,'Boletos comprados:',0,1);
    $pdf->SetFont('Arial','',12);

    if (count($boletos) > 0) {
        foreach ($boletos as $num) {
            $pdf->Cell(0,10,"- Boleto #$num",0,1);
        }
    } else {
        $pdf->Cell(0,10,"(No se encontraron boletos asociados)",0,1);
    }

    // Pie de página
    $pdf->Ln(20);
    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(0,10,'Gracias por su compra. Buena suerte!',0,1,'C');

    // Descargar PDF
    $pdf->Output('D', "Recibo_Sorteo_{$idSorteo}.pdf");

    exit;
?>

<script> //Para redireccionar a la página de los detalles del sorteo
    setTimeout(() => {
        window.location.href = "detallesSorteo.php?id=<?php echo $_GET['idSorteo']; ?>";
    }, 1000);
</script>