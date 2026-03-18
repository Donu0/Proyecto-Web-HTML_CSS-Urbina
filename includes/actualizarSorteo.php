<?php

    require 'conexion.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idSorteo = trim($_POST['idSorteo']);
        $nombreSorteo = trim($_POST['nombreSorteo']);
        $descripcion = trim($_POST['descripcion']);
        $enlaceImagen = trim($_POST['enlaceImagen']);
        $fechaJuego = trim($_POST['fechaJuego']);
        $organizador = trim($_POST['organizador']);
        $boletosRestantes = intval(trim($_POST['boletosRestantes']));
        $precioBoleto = intval(trim($_POST['precioBoleto']));

        // Validación mínima
        if ($idSorteo!="" && $nombreSorteo!="" && $descripcion!="" && $enlaceImagen!="" && $fechaJuego!="" && $organizador!="" && $boletosRestantes!="" && $precioBoleto!="") {
            $stmt = $conexion->prepare("UPDATE sorteo SET nombreSorteo = ?, descripcion = ?, enlaceImagen = ?, fechaJuego = ?, organizador = ?, boletosRestantes = ?, precioBoleto = ? WHERE idSorteo = ?");
            $stmt->bind_param("ssssssss", $nombreSorteo, $descripcion, $enlaceImagen, $fechaJuego, $organizador, $boletosRestantes, $precioBoleto, $idSorteo);
                            // Ni que fuera serpiente, no jala bien si pongo los tipos correctos :/
            $stmt->execute();
            $stmt->close();
        }
    }

    $conexion->close();
    header("Location: ../adminInterface.php");
    exit;
?>