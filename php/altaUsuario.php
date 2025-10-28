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

    if (($nombre!="") && ($apellido!="") && ($correo!="") && ($contrasena!=""))
    {
        // Generar idUsuario aleatorio de 10 caracteres
        $char_string = "01234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $length = 10;
        $idUsuario = substr( str_shuffle( $char_string ), 0, $length );

        $sql = "INSERT INTO `usuario` ( `idUsuario` , `nombre` , `apellido` , `telefono`,  `correo`, `contrasena` ) VALUES ('$idUsuario', '$nombre', '$apellido', '$telefono', '$correo', '$contrasena');";

        $conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) or die("*o*");
        mysqli_query($conexion, "SELECT * FROM usuario");
        mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        echo "<script>";
        echo "alert('Se insertó');";
        echo "</script>";
    }
?>