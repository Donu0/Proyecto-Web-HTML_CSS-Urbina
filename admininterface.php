<?php include 'includes/verificarSesion.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <a href="./quienessomos.php">Quienes somos?</a>
            <a href="./catalogo.php">Catalogo</a>
            <?php
            if ($sesion_activa) {
                // Si el usuario es admin
                if ($_SESSION['rol'] === 'admin') {
                    echo '<a href="./admininterface.php">Admin Panel</a>';
                }
                // Si el usuario tiene sesión activa
                echo '<a href="./logout.php">Cerrar sesión</a>';
            } else {
                // Si no ha iniciado sesión
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

                    <div class="tabla-responsiva">
                        <table>
                            <tr><th>Nombre</th><th>Email</th><th>Rol</th></tr> 
                            <tr>
                                <td>Laura</td><td>laura@example.com</td><td>Admin</td>
                                <td>
                                    <a href="modificarUsuario.php" class="boton" title="Editar">&#9998;</a>
                                    <a href="includes/bajaUsuario.php" class="boton" title="Borrar">&#10060;</a> 
                                </td>
                            </tr> <!--Esto lo vas a quitar pero es un ejemplo de 
                                        Como deben ir los datos que vas a sacar del SQL. Si quieres anadir mas, solo expande la tabla con los elementos q necesites. -->
                            <tr>
                                <td>Donovaaaaaaaaaaaaaaaaan</td><td>dono@example.com</td><td>User</td>
                                <td>
                                    <a href="modificarUsuario.php" class="boton" title="Editar">&#9998;</a>
                                    <a href="includes/bajaUsuario.php" class="boton" title="Borrar">&#10060;</a> <!-- Si le picas desde aca, simplemente que llame el php para borrar -->
                                </td>
                            </tr>          
                        </table>
                    </div>
                </section>
            </details>

            <details>
                <summary>Manejar Sorteos</summary>
                <section>
                    <a class="boton" href="registroSorteo.php">Añadir Sorteo</a>

                    <div class="tabla-responsiva">
                        <table>

                            <tr><th>ID</th><th>Nombre</th><th>Fecha de termino</th></tr>
                            <tr>
                                <td>001</td><td>Sorteo Carro del año</td><td>05/02/2026</td>
                                <td>
                                    <a href="modificarSorteo.php" class="boton" title="Editar">&#9998;</a>
                                    <a href="includes/bajaSorteo.php" class="boton" title="Borrar">&#10060;</a> 
                                </td>
                            </tr>

                            <tr>     
                                <td>002</td><td>Sorteo 一条Donovan</td><td>10/10/2010</td>
                                <td>
                                    <a href="modificarSorteo.php" class="boton" title="Editar">&#9998;</a>
                                    <a href="includes/bajaSorteo.php" class="boton" title="Borrar">&#10060;</a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </section>
            </details>

            <details>
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
            </details>
            
        </div>
    </div>

    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
</body>
</html>