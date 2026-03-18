<?php include 'includes/verificarSesion.php';?>
<?php include 'includes/enviarCorreo.php';?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sortec</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts/carrusel.js"></script>
    <script src="scripts/menuDesplegable.js"></script>
</head>
<body>
    <!-- Titulo de la pagina, Sortec. Que fuente?-->

    <header> <!-- Que colores ponerle? -->
        <!-- Poner imagen -->
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

    <!-- Aqui voy a poner algo parecido al contenido hero de la pagina original, pero quiero un carrusel de las loterias mas padres -->
    <!-- Despues de eso que ams poner?-->
    <section class="contenedor hero">
        <div class="carousel">
            <button class="prev">‹</button>
            
            <div class="carousel-track">
                <div class="slide"><img src="https://images.unsplash.com/photo-1515172013099-a1a53deb7927?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Z2l2ZWF3YXl8ZW58MHx8MHx8fDA%3D    " /></div>
                <div class="slide"><img src="https://images.unsplash.com/photo-1515172013099-a1a53deb7927?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Z2l2ZWF3YXl8ZW58MHx8MHx8fDA%3D" /></div>
                <div class="slide"><img src="https://images.unsplash.com/photo-1515172013099-a1a53deb7927?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Z2l2ZWF3YXl8ZW58MHx8MHx8fDA%3D" /></div>
            </div>

            <button class="next">›</button>
        </div>
    </section>

    
    <!-- Aca voy a poner las secciones principales, contenedor con sus cosas y que aparte sea responsivo para que cuando se encoga la pagina
    Se ponga en flex box vertical.-->

    <main>
        <!-- Acomodarlo con un fondo del color de la pagina, ponerlo en un grid column, en caso de que se minimice entonces row.
         La pagina que hicimos del video ya tiene algo parecido, entonces tomarlo como referencia, pero yo quiero que se vean como
         recuadritos con color en vez de solo texto y el fondo del div. Para mi sera fondo, fondo del div, fondo del item.
         Mero al final poner el contacto.-->

         <!-- Siento que lo que hice aqui es muy redundante. El contenedor es necesario? -->
        <div class="contenedor">
            <div class="contenido-hero">

                <p> Bienvenido a la pagina Sortec, donde se realizan diferentes sorteos en una basis diaria con el objetivo de
                    apoyar a los alumnos e institucion, facilitando la realizacion de venta de boletos y seleccion de resultados.
                </p>
                <div class="contenedor-items">
                    <div class="item-sorteo">
                        <p class="descriptor">Sorteos del Tecnologico</p>
                        <button class="boton" onclick="window.location.href='catalogo.php'">Visitar Pagina</button>
                    </div>

                    <div class="item-sorteo">
                        <p class="descriptor">Sorteos Nacionales</p>
                        <button class="boton" onclick="window.location.href='https://lotenal.gob.mx/'">Visitar Pagina</button>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <section>
            <div class="contenedor">
                <div class="contenido-hero">
                    <h2>Contacto</h2>

                    <p> Ha ocurrido algun inconveniente al momento de usar nuestra pagina? No dudes en contactarnos! Se te atendera en breve. </p>

                    <form class="formulario">
                        <fieldset>
                            <legend>Contactanos llenando los campos</legend>

                            <div class="contenedor-campos">

                                <div class="campo">
                                    <label>Nombre</label>
                                    <input class="input-text" type="text" placeholder="Tu Nombre" name="nombre">
                                    <div class="error"></div>
                                </div>

                                <div class="campo">
                                    <label for="">Teléfono</label>
                                    <input class="input-text" type="tel" placeholder="Tu Teléfono" name="telefono">
                                    <div class="error"></div>
                                </div>

                                <div class="campo">
                                    <label>Correo</label>
                                    <input class="input-text" type="email" placeholder="Tu Email" name="correo">
                                    <div class="error"></div>
                                </div>

                                <div class="campo">
                                    <label>Mensaje</label>
                                    <textarea class="input-text" name="mensaje"></textarea>
                                    <div class="error"></div>
                                </div>

                            </div> <!-- .contenedor-campos -->
                            
                            <div>
                                <input class="boton stretch w-sm-100" type="submit" value="Enviar">
                            </div>

                        </fieldset> 
                    </form>       
                </div>
            </div>
        </section>

    <footer class="footer">     
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>

    <script src="scripts/validacionIndex.js"></script>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    

$(document).ready(function () {

    const $track = $('.carousel-track');
    const $imgs  = $('.carousel img');
    let index = 0;

    function updateSlide() {
        const width = $track.width();
        $track.css('transform', `translateX(-${index * width}px)`);
    }

    $('.next').on('click', function () {
        index = (index + 1) % $imgs.length;
        updateSlide();
    });

    $('.prev').on('click', function () {
        index = (index - 1 + $imgs.length) % $imgs.length;
        updateSlide();
    });

    $(window).on('resize', updateSlide);
});
</script>
