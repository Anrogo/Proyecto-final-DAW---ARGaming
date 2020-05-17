<?php

//debug($posts);

?>
<!-- /.container <div class="container">-->

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
                    </ul>

                    <!--IMÁGENES-->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/img2.jpg" class="img-slider">
                            <div class="carousel-caption">
                                <h3>PRIMER TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 1
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/moto_racer.jpg" class="img-slider">
                            <div class="carousel-caption">
                                <h3>SEGUNDO TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 2
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/banner_image.png" class="img-slider">
                            <div class="carousel-caption">
                                <h3>TERCER TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 3
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/overwatch.png" class="img-slider">
                            <div class="carousel-caption">
                                <h3>CUATRO TÍTULO</h3>
                                <p>
                                    Esta es la descripción de la imagen 4
                                </p>
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
</div>
<div class="container contenido mt-2">
    <div class="row">
        <div class="col-10 col-md-10 col-lg-10 mx-auto">
            <?php
            if (!empty($posts)) {
                foreach ($posts as $post) {
                    echo '<div class="post-preview">
                    <a href="/post/' . $post['id'] . '">
                        <h2 class="post-title">
                            ' . $post['title'] . '
                        </h2>
                    </a>
                    <p class="post-meta">Posted by
                    <a href="/autor/' . $post['author_id'] . '">' . $post['display_name'] . '</a>
                    ' . date("d/m/Y", strtotime($post['created'])) . '</p>
                    <p class="post-meta">
                        ' . $post['brief'] . '
                    </p>
                </div>
                <hr>';
                }
            } else {
                echo $title;
                echo "<br>";
                echo $mensaje_confirmacion;
                echo "<br>";
            }
            ?>

        </div>
    </div>
</div>