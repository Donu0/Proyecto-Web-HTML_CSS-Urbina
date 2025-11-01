<?php

    require 'conexion.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['ids'])) {
        $ids = $_POST['ids'];

        // Validar que todas sean cadenas no vacías
        $ids_limpios = array_filter($ids, fn($idUsuario) => !empty(trim($idUsuario)));

        if (!empty($ids_limpios)) {
            // Crear placeholders dinámicos para consulta preparada
            $placeholders = implode(',', array_fill(0, count($ids_limpios), '?'));

            // Preparar consulta segura
            $sql = "DELETE FROM Usuario WHERE idUsuario IN ($placeholders)";
            $stmt = $conexion->prepare($sql);

            // Vincular parámetros dinámicamente
            $tipos = str_repeat('s', count($ids_limpios)); // todas son cadenas
            $stmt->bind_param($tipos, ...$ids_limpios);

            $stmt->execute();
            $stmt->close();
        }
}

    $conexion->close();
    header("Location: ../admininterface.php");
    exit();
?>