<?php

//debug($posts);

?>
<!-- /.container <div class="container">-->

    <div class="container-fluid portada">
            <h2 class="titulo-blog">BIENVENIDO A ARGaming</h2>
            <p class="small">Blog de videojuegos</p>
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
            }
            ?>

        </div>
    </div>
</div>