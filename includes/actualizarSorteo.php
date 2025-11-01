<?php

    require 'conexion.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idSorteo = trim($_POST['idSorteo']);
        $nombreSorteo = trim($_POST['nombreSorteo']);
        $descripcion = trim($_POST['descripcion']);
        $fechaJuego = trim($_POST['fechaJuego']);
        $organizador = trim($_POST['organizador']);
        $boletosRestantes = intval(trim($_POST['boletosRestantes']));
        $precioBoleto = intval(trim($_POST['precioBoleto']));

        // Validación mínima
        if ($idSorteo!="" && $nombreSorteo!="" && $descripcion!="" && $fechaJuego!="" && $organizador!="" && $boletosRestantes!="" && $precioBoleto!="") {
            $stmt = $conexion->prepare("UPDATE sorteo SET nombreSorteo = ?, descripcion = ?, fechaJuego = ?, organizador = ?, boletosRestantes = ?, precioBoleto = ? WHERE idSorteo = ?");
            $stmt->bind_param("sssssss", $nombreSorteo, $descripcion, $fechaJuego, $organizador, $boletosRestantes, $precioBoleto, $idSorteo);
            $stmt->execute();
            $stmt->close();
        }
    }

    $conexion->close();
    header("Location: ../adminInterface.php");
    exit;
?>