<?php include 'includes/verificarSesion.php';
    //Por el momento solo el admin puede modificar usuarios
    if ($usuario_rol !== 'admin') {
        header("Location: index.php");
        exit;
    } 

    // Validar que venga el parámetro id
    if (!isset($_GET['Usuario']) || empty($_GET['Usuario'])) {
        header("Location: adminInterface.php");
        exit;
    }

    $idUsuario = $_GET['Usuario'];

    // Consultar datos del usuario
    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
    $stmt->bind_param("s", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Si no existe, rediriger a la interfaz de admin
        $stmt->close();
        $conn->close();
        header("Location: adminInterface.php");
        exit;
    }

    $usuario = $result->fetch_assoc();
    $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
     <header class>
        <h1 class="titulo">Sortec</h1>
        <span class="subtitulo"> Sorteamos cosas </span> 
    </header>

    <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="./index.html">Inicio</a>
            <a href="./quienesSomos.html">Quienes somos?</a>
            <a href="./catalogo.html">Catalogo</a>
            <?php
            if ($sesion_activa) {
                // Si el usuario es admin
                if ($_SESSION['rol'] === 'admin') {
                    echo '<a href="./adminInterface.php">Admin Panel</a>';
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
            <h2>Modificar Usuarios</h2>
            <p> Modifica los datos que desees reemplazar</p>

            <form method="POST" action="includes/actualizarUsuario.php" class="formulario">
                <fieldset>
                    
                    <div class="contenedor-registro">
                        <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($usuario['idUsuario']); ?>">
                        
                        <div class="campo">
                            <label>Nombre</label>
                            <input class="input-text" type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
                        </div>

                        <div class="campo">
                            <label>Apellido</label>
                            <input class="input-text" type="text" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" required>
                        </div>

                        <div class="campo">
                            <label>Teléfono</label>
                            <input class="input-text" type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>" required>
                        </div>
                        
                        <div class="campo">
                            <label>Correo</label>
                            <input class="input-text" type="email" name="correo" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>
                        </div>

                        <div class="campo">
                            <label>Contraseña</label>
                            <input class="input-text" type="password" name="contrasena" value="<?php echo htmlspecialchars($usuario['contrasena']); ?>" required>
                        </div>

                        <div class='campo'>
                            <label>Rol</label>
                            <select name='rol' class='input-text' required>
                                <option value='user' <?php if ($usuario['rol'] === 'user') echo 'selected'; ?>>Usuario</option>
                                <option value='admin' <?php if ($usuario['rol'] === 'admin') echo 'selected'; ?>>Administrador</option>
                            </select>
                        </div>

                    </div> 
                    
                </fieldset>

                <div>
                    <input class="boton" type="submit" value="Guardar Cambios">
                    <a href ="adminInterface.php" class="boton">Cancelar</a>
                </div>                

            </form>
        </div>
    </div>

    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
    
</body>
</html>