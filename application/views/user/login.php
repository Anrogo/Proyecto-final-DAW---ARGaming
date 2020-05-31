<div class="wrapper">
  <form class="login" action="/login2" method="POST">
    <p class="title">Inicio de sesión</p>
    <?php

    # Si existe la variable error que envia el controlardo mostraremos el error.
    if (isset($error)) {
      echo "<p class='error'>$error</p>";
    }

    ?>
    <input type="text" name="username" placeholder="Nombre de usuario" title="Introduzca su nombre de usuario" autofocus />
    <i class="fas fa-user"></i>
    <input type="password" name="password" placeholder="Contraseña" title="Introduzca su contraseña" />
    <i class="fas fa-key"></i>
    <a href="cambiar-password">Ha olvidado su contraseña?</a><br>
    <span><a href="registro">Puede registrarse aquí</a></span>
    <button>
      <i class="spinner"></i>
      <span class="state">Iniciar sesión</span>
    </button>
  </form>
  <div class="text-center">
    <a href="/" class="text-return">Cancelar y volver a la página de inicio</a>
  </div>
  <footer><a target="blank" href="http://boudra.me/">Designed by boudra.me</a></footer>
  </p>
</div>