<?php
    $dbhost = "localhost";
    $dbname = "sortec";
    $dbuser = "root";
    $dbpass = "";
    $dbport = "3306";

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $rol = $_POST["rol"];

    if (($nombre!="") && ($apellido!="") && ($telefono!="") && ($correo!="") && ($contrasena!="") && ($rol!=""))
    {
        // Generar idUsuario aleatorio de 10 caracteres
        $char_string = "01234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $length = 10;
        $idUsuario = substr( str_shuffle( $char_string ), 0, $length );

        $sql = "INSERT INTO `usuario` ( `idUsuario` , `nombre` , `apellido` , `telefono`,  `correo`, `contrasena`, `rol` ) 
                VALUES ('$idUsuario', '$nombre', '$apellido', '$telefono', '$correo', '$contrasena', '$rol');";

        $conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) or die("*o*");
        mysqli_query($conexion, "SELECT * FROM usuario");
        mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        //Después de registrar al usuario, redirigir a la página de acceso
        header("Location: ../acceder.php");
    } 
?>