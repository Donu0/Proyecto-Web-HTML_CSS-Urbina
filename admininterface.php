<?php include 'includes/verificarSesion.php'; 
    require 'includes/conexion.php';

    if ($_SESSION['rol'] !== 'admin') {
        // Redirigir a la página de acceso si no es admin
        header("Location: acceder.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz Administrador</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header> 
        <h1 class="titulo">Sortec</h1>
        <span class="subtitulo"> Sorteamos cosas </span> 
    </header>

    <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="./index.php">Inicio</a>
            <a href="./quienesSomos.php">Quienes somos?</a>
            <a href="./catalogo.php">Catalogo</a>
            <?php
                if ($sesion_activa) {
                    $nombreUsuario = $_SESSION['nombre'];
                    
                    if ($_SESSION['rol'] === 'admin') {
                        echo '<a href="./adminInterface.php">Admin Panel</a>';
                    }

                    echo '
                        <div class="user-menu">
                            <button class="user-btn">Hola, ' . htmlspecialchars($nombreUsuario) . ' ▼</button>
                            <div class="user-dropdown">
                                <a href="./logout.php">Cerrar sesión</a>
                            </div>
                        </div>
                    ';
                } else {
                    echo '<a href="./acceder.php">Acceder</a>';
                }
            ?>
        </nav> 
    </div> 

    <div class="contenedor">
        <div class="contenido-hero">
            <p>Herramientas de administrador</p>

            <details open>
                <summary>Manejar usuarios</summary>
                <section>
                    <a class="boton" href="registroUsuario.php">Añadir usuario</a>

                    <form method="POST" action="./includes/bajaUsuario.php" style="display:inline;">
                        <div class="tabla-responsiva">
                            <?php
                            // Consulta para obtener todos los usuarios
                                $sql = "SELECT * FROM usuario";
                                $resultado = $conexion->query($sql);    

                                if ($resultado->num_rows > 0) {
                                    echo '<table class="tabla-usuarios">';
                                    echo '<tr><th>Seleccionar</th><th>ID</th><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>Correo</th><th>Rol</th></tr>';

                                    while ($fila = $resultado->fetch_assoc()) {
                                        echo "<tr>
                                                <td><input type='checkbox' name='ids[]' value='{$fila['idUsuario']}'></td>
                                                <td>{$fila['idUsuario']}</td>
                                                <td>{$fila['nombre']}</td>
                                                <td>{$fila['apellido']}</td>
                                                <td>{$fila['telefono']}</td>
                                                <td>{$fila['correo']}</td>
                                                <input type='hidden' name='contrasena' value'{$fila['contrasena']}'>
                                                <td>{$fila['rol']}</td>
                                                <td>
                                                    <a href='modificarUsuario.php?Usuario=" . urlencode($fila['idUsuario']) . "' class='boton' title='Editar'>&#9998;</a>
                                                </td>
                                            </tr>";
                                    }

                                    echo '</table>';
                                } else {
                                    echo "<p style='text-align:center;'>No hay usuarios registrados.</p>";
                                }

                                //$conexion->close();
                            ?>
                        </div>

                        <div>
                            <button class="boton" type="submit">Eliminar seleccionado(s)</a>
                        </div>
                    </form>
                </section>
            </details>

            <details open>
                <summary>Manejar Sorteos</summary>
                <section>
                    <a class="boton" href="registroSorteo.php">Añadir Sorteo</a>

                    <form method="POST" action="./includes/bajaSorteo.php" style="display:inline;">
                        <div class="tabla-responsiva">
                            <?php
                            // Consulta para obtener todos los sorteos
                                $sql = "SELECT * FROM sorteo";
                                $resultado = $conexion->query($sql);    

                                if ($resultado->num_rows > 0) {
                                    echo '<table class="tabla-sorteos">';
                                    echo '<tr><th>Seleccionar</th><th>ID</th><th>Sorteo</th><th>Descripcion</th><th>Fecha de Término</th><th>Organizador</th><th>Disponibles</th><th>Precio</th></tr>';

                                    while ($fila = $resultado->fetch_assoc()) {
                                        echo "<tr>
                                                <td><input type='checkbox' name='ids[]' value='{$fila['idSorteo']}'></td>
                                                <td>{$fila['idSorteo']}</td>
                                                <td>{$fila['nombreSorteo']}</td>
                                                <td>{$fila['descripcion']}</td>
                                                <input type='hidden' name='enlaceImagen' value='" . htmlspecialchars($fila['enlaceImagen']) . "'> 
                                                <td>{$fila['fechaJuego']}</td>
                                                <td>{$fila['organizador']}</td>
                                                <td>{$fila['boletosRestantes']}</td>
                                                <td>{$fila['precioBoleto']}</td>
                                                <td>
                                                    <a href='modificarSorteo.php?Sorteo=" . urlencode($fila['idSorteo']) . "' class='boton' title='Editar'>&#9998;</a>
                                                </td>
                                            </tr>";
                                    }

                                    echo '</table>';
                                } else {
                                    echo "<p style='text-align:center;'>No hay sorteos registrados.</p>";
                                }

                                $conexion->close();
                            ?>
                        </div>

                        <div>
                            <button class="boton" type="submit">Eliminar seleccionado(s)</a>
                        </div>
                    </form>
                </section>
            </details>
             
            <!-- Creo que por el momento no es necesario, lo dejaré para el final -->
            <!-- <details>
                <summary>Sesiones y Login</summary>
                <section>
                    <div class="tabla-responsiva">
                        <table>

                            <tr><th>ID Login</th><th>ID Usuario</th><th>Nombre Usuario</th><th>Fecha Login</th></tr>
                            <tr>
                                <td>001</td><td>1</td><td>Donovannnnnnnnnnnnnnn</td><td>29/10/2025</td>
                            </tr>

                            <tr>     
                                <td>002</td><td>2</td><td>Laura</td><td>20/10/2025</td>
                            </tr>

                        </table>
                    </div>
                </section>
            </details> -->
        </div>
    </div>

    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>

    <script src="scripts/menuDesplegable.js"></script>
</body>
</html>