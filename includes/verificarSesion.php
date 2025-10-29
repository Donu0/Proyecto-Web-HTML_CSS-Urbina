<?php
session_start();
require 'includes/conexion.php';

// Este archivo no redirige. Solo define variables de sesión si existen.
// Así puedes incluirlo en cualquier página (pública o privada) y decidir qué hacer.

$sesion_activa = false;
$usuario_nombre = "";
$usuario_rol = "";

if (isset($_SESSION['idUsuario'])) {
    $sesion_activa = true;
    $usuario_nombre = $_SESSION['nombre'];
    $usuario_rol = $_SESSION['rol'];
}
?>
