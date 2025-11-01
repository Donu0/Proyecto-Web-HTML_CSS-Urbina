<?php

    require 'conexion.php';
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idUsuario = trim($_POST['idUsuario']);
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $telefono = trim($_POST['telefono']);
        $correo = trim($_POST['correo']);
        $contrasena = trim($_POST['contrasena']);
        $rol = trim($_POST['rol']);

        // Validación mínima
        if ($idUsuario!="" && $nombre!="" && $apellido!="" && $correo!="" && $contrasena!="" && $rol!="") {
            $stmt = $conexion->prepare("UPDATE usuario SET nombre = ?, apellido = ?, telefono = ?, correo = ?, contrasena = ?, rol = ? WHERE idUsuario = ?");
            $stmt->bind_param("sssssss", $nombre, $apellido, $telefono, $correo, $contrasena, $rol, $idUsuario);
            $stmt->execute();
            $stmt->close();
        }
    }

    $conexion->close();
    header("Location: ../admininterface.php");
    exit;
?>