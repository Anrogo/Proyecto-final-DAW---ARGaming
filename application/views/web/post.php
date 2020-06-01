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
        <a href="#"><a href="#<?php echo $post['id_usuario']; ?>"><?php echo ($autor['username'] == '') ? 'Anónimo' : $autor['username']; ?></a></a>
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
        echo str_replace("\n", "<br>", $post['contenido']);
        ?>
      </p>
      <hr>

      <!-- Comments Form -->
      <div class="card my-4">
        <h5 class="card-header">Deja tu comentario:</h5>
        <div class="card-body">
          <!--Se inserta, tras la url de agregar-comentario, el id para indicar a que post pertenece este comentario-->
          <form action="/post/<?php echo $post['id_post']; ?>/agregar-comentario" method="POST">
            <div class="form-group">
              <input name="email" id="email" class="form-control" placeholder="Escribe tu correo">
              <?php
              echo form_error('email', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
              </svg>', '</div>'); ?>
            </div>
            <div class="form-group">
              <textarea name="comentario" id="comentario" class="form-control" rows="3" placeholder="Y ahora ya puedes exponer tu opinión sobre este post. Recuerda respetar a los demás usuarios y ante todo, hablar con educación."></textarea>
              <?php
              echo form_error('comentario', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
              </svg>', '</div>'); 
              echo isset($usuario_no_registrado) ? $usuario_no_registrado : '' ;
              ?>
            </div>
            <input type="submit" class="btn btn-outline-primary" value="Comentar">
          </form>
        </div>
      </div>

      <?php

      foreach ($comentarios as $comentario) {

        $fecha_hora = explode(" ", $comentario['creado']);
        $fecha = implode("/", array_reverse(explode("-", $fecha_hora[0])));//función que formatea la fecha, cambia los '-' por '/' y cambia el orden de año, mes y día de inglés a español
        $hora = $fecha_hora[1];

        //Imagenes de perfil. Selecciono la ruta y si no contiene nada se pone una imagen predeterminada
        $ruta_foto = ($comentario['imagen_perfil'] == '') ? 'http://placehold.it/60x60' : '/images/fotos_perfil/' . $comentario['imagen_perfil'];
      ?>

        <!-- Single Comment -->
        <div class="media mb-4">
        <div class="foto-perfil mr-2">
            <img class="d-flex img-fluid" src="<?php echo $ruta_foto; ?>" alt="">
          </div>
          <div class="media-body">
            <h5 class="titulo-comentario mt-0 font-weight-bold">
              <?php echo $comentario['username']; ?>
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
        <h5 class="card-header">Búsqueda</h5>
        <div class="card-body">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar...">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button">Encontrar</button>
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