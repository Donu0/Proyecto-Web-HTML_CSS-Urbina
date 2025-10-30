<?php include 'includes/verificarSesion.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sortec</title>
    <link rel="stylesheet" href="css/styles.css">
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

    <!-- Aqui voy a poner algo parecido al contenido hero de la pagina original, pero quiero un carrusel de las loterias mas padres -->
    <!-- Despues de eso que ams poner?-->
    <section class="contenedor hero">
        <div class="carousel">
            <div class="carousel-item"><img src="https://picsum.photos/id/1015/800/300" alt="1"></div>
            <div class="carousel-item"><img src="https://picsum.photos/id/1016/800/300" alt="2"></div>
            <div class="carousel-item"><img src="https://picsum.photos/id/1018/800/300" alt="3"></div>
            <div class="carousel-item"><img src="https://picsum.photos/id/1020/800/300" alt="4"></div>
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
                        <button class="boton">Pagina 1</button>
                    </div>

                    <div class="item-sorteo">
                        <p class="descriptor">Sorteos Semanales</p>
                        <button class="boton">Pagina 2</button>
                    </div>

                    <div class="item-sorteo">
                        <p class="descriptor">Sorteos Nacionales</p>
                        <button class="boton">Pagina 3</button>
                    </div>
                </div>

                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi unde nesciunt aspernatur minima. Ad quae facilis id quam minus culpa, fugit sit quas officiis porro voluptatem doloribus deleniti aut! Aperiam. </p>
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
                                    <input class="input-text" type="text" placeholder="Tu Nombre">
                                </div>

                                <div class="campo">
                                    <label for="">Teléfono</label>
                                    <input class="input-text" type="tel" placeholder="Tu Teléfono">
                                </div>

                                <div class="campo">
                                    <label>Correo</label>
                                    <input class="input-text" type="email" placeholder="Tu Email">
                                </div>

                                <div class="campo">
                                    <label>Mensaje</label>
                                    <textarea class="input-text"></textarea>
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

</body>
</html>