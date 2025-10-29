<?php
    $dbhost = "localhost";
    $dbname = "sortec";
    $dbuser = "root";
    $dbpass = "";
    $dbport = "3306";

    $conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);    

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
?>
