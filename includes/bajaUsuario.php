<?php
    $dbhost = "localhost";
    $dbname = "sortec";
    $dbuser = "root";
    $dbport = "3306";
    $dbpass = "";

    $idUsuario = $_POST["idUsuario"];

    if (($idUsuario != "")) 
    {
        $sql = "DELETE FROM `usuario` WHERE idUsuario = `idUsuario`;";

        $conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) or die("*o*");
        mysqli_query($conexion, "SELECT * FROM usuario");
        mysqli_query($conexion, $sql);
        mysqli_close($conexion);
    }
?>