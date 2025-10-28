<?php
    $dbhost = "localhost";
    $dbname = "pasteleria";
    $dbuser = "root";
    $dbpass = "";
    $dbport = "3306";

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    if (($nombre!="") && ($apellido!="") && ($correo!="") && ($contrasena!=""))
    {
        $sql = "INSERT INTO `usuario` ( `idUsuario` , `nombre` , `correo`, `contrasena` ) VALUES ('$idUsuario', '$nombre', '$correo', '$contrasena');";

        $conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) or die("*o*");
        mysqli_query($conexion, "SELECT * FROM usuario");
        mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        echo "<script>";
        echo "alert('Se insertó');";
        echo "</script>";
    }
?>