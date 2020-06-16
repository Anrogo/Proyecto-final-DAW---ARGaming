<!-- /.container <div class="container">-->
<!--CARRUSEL DE IMAGENES-->
<div class="container-fluid portada">
    <div class="row text-center">
        <div class="col">
            <div id="demo1" class="carousel slide" data-ride="carousel">

                <!--INDICADORES-->
                <ul class="carousel-indicators">
                    <li data-target="#demo1" data-slide-to="0" class="active"></li>
                    <li data-target="#demo1" data-slide-to="1"></li>
                    <li data-target="#demo1" data-slide-to="2"></li>
                    <li data-target="#demo1" data-slide-to="3"></li>
                    <li data-target="#demo1" data-slide-to="4"></li>
                    <li data-target="#demo1" data-slide-to="5"></li>
                    <li data-target="#demo1" data-slide-to="6"></li>
                    <li data-target="#demo1" data-slide-to="7"></li>
                    <li data-target="#demo1" data-slide-to="8"></li>
                    <li data-target="#demo1" data-slide-to="9"></li>
                </ul>

                <!--IMÁGENES-->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/images/slider/cod-slider.jpg" class="img-slider">
                        <div class="carousel-caption">
                            <!--
                                <h3>PRIMER TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 1
                                </p>
                                -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/images/slider/ac-slider.jpg" class="img-slider">
                        <div class="carousel-caption">
                            <!--    
                                <h3>SEGUNDO TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 2
                                </p>
                                -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider/dark-souls-slider.jpg" class="img-slider">
                        <div class="carousel-caption">
                            <!--    
                                <h3>TERCER TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 3
                                </p>
                                -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider/fornite-slider.jpg" class="img-slider">
                        <div class="carousel-caption">
                            <!--
                                <h3>CUARTO TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 4
                                </p>
                                -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider/overwatch2-slider.png" class="img-slider">
                        <div class="carousel-caption">
                            <!--
                                <h3>QUINTO TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 5
                                </p>
                                -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider/minecraft2-slider.jpg" class="img-slider">
                        <div class="carousel-caption">
                            <!--
                                <h3>SEXTO TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 6
                                </p>
                                -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider/csgo-slider.png" class="img-slider">
                        <div class="carousel-caption">
                            <!--
                                <h3>SÉPTIMO TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 7
                                </p>
                                -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider/overwatch-slider.png" class="img-slider">
                        <div class="carousel-caption">
                            <!--
                                <h3>OCTAVO TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 8
                                </p>
                                -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider/skyrim-slider.jpg" class="img-slider">
                        <div class="carousel-caption">
                            <!--
                                <h3>NOVENO TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 9
                                </p>
                                -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider/moto-racer-slider.jpg" class="img-slider">
                        <div class="carousel-caption">
                            <!--
                                <h3>DÉCIMO TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 10
                                </p>
                                -->
                        </div>
                    </div>
                </div>

                <!--CONTROLES A IZQUIERDA Y DERECHA-->
                <a class="carousel-control-prev" href="#demo1" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#demo1" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark mt-3 mb-3 pt-2 w-100">
    <?php
    if (isset($mensaje_confirmacion)) {
    ?>
        <div class="row justify-content-center">
            <div class="col-10">
                <?php
                echo $mensaje_confirmacion;
                ?>
            </div>
        </div>
    <?php
    }
    ?>

    <div class="container bg-light">
        <!-- Three columns of text below the carousel -->
        <div class="row p-4">
            <div class="col-12 col-lg-4">
                <img src="/images/post/ps5-vs-xbox-series-x.webp" class="img-fluid" alt="foto-post-1">
                <h3 class="text-primary"><a href="/post/novedades/1">Un analista predice que PS5 venderá casi el doble que Xbox Series X para 2024</a></h3>
                <p>La firma Ampere estima que PlayStation 5 venderá 66 millones de unidades para ese año...</p>
                <p><a class="btn btn-outline-secondary" href="/post/novedades/1" role="button">Ver más &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-12 col-lg-4">
                <img src="/images/post/silent-hill-dbd.jpg" class="img-fluid" alt="foto-post-2">
                <h3 class="text-primary"><a href="/post/novedades/2">Silent Hill regresa por la puerta pequeña de la mano de una colaboración con Behaviour Interactive</a></h3>
                <p>Aunque no es lo que muchos esperan, los creadores de Dead By Daylight nos traen...</p>
                <p><a class="btn btn-outline-secondary" href="/post/novedades/2" role="button">Ver más &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-12 col-lg-4">
                <img src="/images/post/warzone-portada.webp" class="img-fluid" alt="foto-post-3">
                <h3 class="text-primary"><a href="/post/novedades/1">La temporada 4 de ‘Call of Duty: Modern Warfare’ y ‘Warzone’ ya está aquí: estas son sus novedades</a></h3>
                <p>La temporada 4 de de 'Call of Duty: Modern Warfare' y 'Warzone' ya se encuentra...</p>
                <p><a class="btn btn-outline-secondary" href="/post/novedades/3" role="button">Ver más &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->

        <!--TABLA/LISTADO DE POST-->

        <div class="row">

            <div class="col-lg-12 text-center">
                <?php
                if (isset($posts)) {

                ?>
                    <table class="table table-responsive">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">Imagen</th>
                                <th scope="col">Título</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Última modificación</th>
                                <th scope="col">Abierto</th>
                                <th scope="col">Visitas</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                        foreach ($posts as $post) {

                            //Se filtran algunos valores clave
                            if ($post['estado'] == "1") {
                                $abierto = "<img src='/images/activo.png'  width=20px>";
                            } else {
                                $abierto = "<img src='/images/no_activo.png' width=20px>";
                            }

                            //Se procesan los datos recibidos
                            $id = $post['id_post'];
                            $titulo = $post['titulo'];
                            $contenido = strlen($post['contenido']) > 60 ? substr($post['contenido'], 0, 60) . "..." : $post['contenido'];
                            $imagen = $post['imagen_post'];
                            $modificado = $post['modificado'];
                            $activo = $post['estado'] == 1 ? 'Activo' : 'Cerrado';
                            $link = $post['slug'];
                            $visitas = $post['visitas'];

                            //Y se muestran en forma de tabla
                            echo "<tr id=\"" . $id . "\">
                            <td><img src=\"/images/" . $imagen . "\"  width=\"200px\"></td>
                            <td><a href=\"/post/" . $id . "\">" . $titulo . "</a></td>
                            <td>" . $contenido . " </td>
                            <td><a href=\"post/" . $id . "\">$link</a></td>
                            <td>" . $modificado . " </td>
                            <td class=\"text-center\">" . $abierto . "</td>
                            <td class=\"text-center\">" . $visitas . "</td>
                            </tr>";
                        }
                    } else {
                        echo "Algo ha fallado al obtener el listado... Disculpe las molestias";
                    }

                        ?>


                        </tbody>
                    </table>

            </div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php
if (isset($cookies)) {
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="mensaje-cookies">
                    <div class="text-center">
                    <?php
                    echo $cookies;
                }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>