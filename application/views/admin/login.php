<div class="container">

  <div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
      <?php

        # Si existe la variable error que envia el controlardo mostraremos el error.
        if ( isset( $error))
        {
          echo "<div class='error'>$error</div>";
        }

      ?>
     <!--  <form class="form-signin" method="POST" action="/login/login"> -->
      <form  name="login" id="login" action="/admin/login2" method="post">
        <h4 class="form-signin-heading">Por favor, registrese</h4>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="email_login" name="email_login" class="form-control frm_login_email" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" id="login_password" name="login_password" class="form-control frm_login_pass" placeholder="Contraseña" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
        <br><br>
        <a class="btn btn-lg btn-warning btn-block" href="/login/registro">Alta nuevo usuario</a>
      </form>
    </div>
    <div class="col-lg-4"></div>

  </div>

</div> <!-- /container -->