<?php
  
  $post = $post[0];
  $autor = $autor[0];

?>
<!-- Page Content -->
<div class="container mt-3">

<div class="row">

  <!-- Post Content Column -->
  <div class="col-lg-8">

    <!-- Title -->
    <h1 class="mt-4"><?php echo $post['titulo']; ?></h1>

    <!-- Author -->
    <p class="lead">
      By
      <a href="#"><a href="#<?php echo $post['id_usuario']; ?>"><?php echo ($autor['username']=='') ? 'Anónimo' : $autor['username']; ?></a></a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p class="small">Posteado el <?php echo $post['creado']; ?></p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="/images/<?php echo $post['imagen_post']; ?>" alt="post">

    <hr>

    <!-- Post Content -->
    <p class="lead"></p>

    <p>
      <?php 
        echo str_replace( "\n", "<br>", $post['contenido']); 
      ?>
      </p>
    <hr>

    <!-- Comments Form -->
    <div class="card my-4">
      <h5 class="card-header">Deja tu comentario:</h5>
      <div class="card-body">
        <form>
        <div class="form-group">
            <input name="email" id="email" class="form-control" placeholder="Escribe tu correo">
          </div>
          <div class="form-group">
            <textarea name="comentario" id="comentario" class="form-control" rows="3" placeholder="Y ahora ya puedes exponer tu opinión sobre este post. Recuerda respetar a los demás usuarios y ante todo, hablar con educación."></textarea>
          </div>
          <button type="submit" class="btn btn-outline-primary">Comentar</button>
        </form>
      </div>
    </div>

    <?php

foreach ($comentarios as $comentario) {

  $array = explode(" ",$comentario['creado']);
  $fecha = implode("/",array_reverse(explode("-",$array[0])));//función que formatea la fecha, cambia los '-' por '/' y cambia el orden de año, mes y día de inglés a español
  $hora = $array[1];
    ?>

    <!-- Single Comment -->
    <div class="media mb-4">
      <img class="d-flex mr-3" src="http://placehold.it/60x60" alt="">
      <div class="media-body">
        <h5 class="titulo-comentario mt-0">
          <?php echo $comentario['username'];?>
          </h5>
          <span class="small">
            <?php echo $fecha . " a las " . $hora; ?>
          </span>
      
        
        <p>
        <?php echo $comentario['texto']; ?>
        </p>
      </div>
    </div>
    <?php

}
    ?>
    <!-- Comment with nested comments -->
    <div class="media mb-4">
      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
      <div class="media-body">
        <h5 class="mt-0">Commenter Name</h5>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

        <div class="media mt-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          </div>
        </div>

        <div class="media mt-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          </div>
        </div>

      </div>
    </div>

  </div>

  <!-- Sidebar Widgets Column -->
  <div class="col-md-4">

    <!-- Search Widget -->
    <div class="card my-4">
      <h5 class="card-header">Search</h5>
      <div class="card-body">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>

    <!-- Links relacionados -->
    <div class="card my-4">
      <h5 class="card-header">Otros enlaces que te pueden interesar</h5>
      <div class="card-body">
      <ul class="list-group">
        <li class="list-group-item"><a href="#">Primer juego de la historia</a></li>
        <li class="list-group-item"><a href="#">Los 10 videojuegos más exitosos del momento</a></li>
        <li class="list-group-item"><a href="#">El juego con más descargas del 2019</a></li>
      </ul>
      </div>
    </div>
</div>