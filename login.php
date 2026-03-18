<?php
session_start();
require 'includes/conexion.php';

// Obtener los datos del formulario
$correo = $_POST['correo'];
$password = $_POST['contrasena'];

// Consulta para verificar usuario
$sql = "SELECT * FROM usuario WHERE correo = '$correo'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    // Verificar contraseña (en producción usa password_hash / password_verify)
    if ($usuario['contrasena'] === $password) {

        // Crear variables de sesión
        $_SESSION['idUsuario'] = $usuario['idUsuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];
        $_SESSION['correo'] = $usuario['correo'];

        // Redireccionar según el rol
        if ($usuario['rol'] === 'admin') {
            header("Location: adminInterface.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        // Tantito JS?
        echo "<script>alert('Contraseña incorrecta'); window.location.href='acceder.php';</script>";
    }
} else {
    echo "<script>alert('Usuario no encontrado'); window.location.href='acceder.php';</script>";
}
//$conexion->close();
?>
