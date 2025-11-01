<?php
    require 'conexion.php';
    session_start();

    $idSorteo = rand(0, 10000000000);
    $nombreSorteo = $_POST["nombreSorteo"];
    $descripcion = $_POST["descripcion"];
    $fechaJuego = $_POST["fechaJuego"];
    $organizador = $_POST["organizador"];
    $boletosRestantes = $_POST["boletosRestantes"];
    $precioBoleto = inttval($_POST["precioBoleto"]);

    if (($idSorteo>=0) && ($nombreSorteo!="") && ($descripcion!="") && ($fechaJuego!="") && ($organizador!="") && ($boletosRestantes!="") && ($precioBoleto!=""))
    {
        $stmt = $conexion->prepare("INSERT INTO sorteo (idSorteo, nombreSorteo, descripcion, fechaJuego, organizador, boletosRestantes, precioBoleto)
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $idSorteo, $nombreSorteo, $descripcion, $fechaJuego, $organizador, $boletosRestantes, $precioBoleto);
        $stmt->execute();
        $stmt->close();

        //Después de registrar el sorteo, redirigir a la página de interfaz de admin
        header("Location: ../adminInterface.php");
    } 
?>