<div class="container">

  <div class="row justify-content-center">
    <div class="col-md-4 col-md-offset-4 col-lg-4">
    <br><br>
      <h2 class="">Inicio de sesión</h2>
      <?php

        # Si existe la variable error que envia el controlardo mostraremos el error.
        if ( isset( $error))
        {
          echo "<div class='error'>$error</div>";
        }

      ?>
     <!--  <form class="form-signin" method="POST" action="/login/login"> -->
      <form action="/login2" method="POST">
        <div class="form-group">
          <label for="username">Usuario</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="nombre de usuario / nombre@email.es" required>
        </div>
        
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
        
        <input type="submit" class="btn btn-outline-success" value="Iniciar sesión">
      </form>
    </div>

  </div>

</div> <!-- /container -->