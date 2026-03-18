<?php
    require 'conexion.php';
    include 'verificarSesion.php'; // Solo para mantener la sesión si existe

    // Validar que venga el id del sorteo
    if (!isset($_POST['numeros']) || !isset($_POST['idSorteo'])) {
        header("Location: ../catalogo.php");
        exit;
    }

    $idSorteo = intval($_POST['idSorteo']);
    $numerosSeleccionados = $_POST['numeros'];

    $char_string = "01234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $length = 4;
    $idGenerica = 'generic' . substr( str_shuffle( $char_string ), 0, $length );

    // Si el usuario tiene sesión, usamos su id; si no, ponemos una idUsuario genérica para bolbetos comprados sin registro
    $idUsuario = $sesion_activa ? $_SESSION['idUsuario'] : $idGenerica;

    // Verificamos que el sorteo exista y tenga boletos disponibles
    $stmt = $conexion->prepare("SELECT boletosRestantes FROM Sorteo WHERE idSorteo = ?");
    $stmt->bind_param("i", $idSorteo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        $stmt->close();
        $conexion->close();
        header("Location: ../catalogo.php");
        exit;
    }

    $sorteo = $resultado->fetch_assoc();
    $stmt->close();

    $boletosDisponibles = intval($sorteo['boletosRestantes']);
    $totalSeleccionados = count($numerosSeleccionados);

    // Insertar boletos seleccionados
    $stmtInsert = $conexion->prepare("INSERT INTO boleto (idBoleto, numero, idUsuario, idSorteo) VALUES (?, ?, ?, ?)");

    foreach ($numerosSeleccionados as $num) {
        $idBoleto = rand(0, 1000000000);
        $num = intval($num);
        $stmtInsert->bind_param("ssss", $idBoleto, $num, $idUsuario, $idSorteo);
            
        $stmtInsert->execute();
    }
    $stmtInsert->close();

    // Actualizar boletos restantes
    $nuevosRestantes = $boletosDisponibles - $totalSeleccionados;
    $stmtUpdate = $conexion->prepare("UPDATE Sorteo SET boletosRestantes = ? WHERE idSorteo = ?");
    $stmtUpdate->bind_param("ii", $nuevosRestantes, $idSorteo);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    $conexion->close();
?>
