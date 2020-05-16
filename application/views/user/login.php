<div class="wrapper">
<form class="login" action="/login2" method="POST">
<p class="title">Inicio de sesión</p>
<?php

        # Si existe la variable error que envia el controlardo mostraremos el error.
        if ( isset( $error))
        {
          echo "<p class='error'>$error</p>";
        }

      ?>
<input type="text" name="username" placeholder="Nombre de usuario" title="Introduzca su nombre de usuario" autofocus />
<i class="fas fa-user"></i>
<input type="password" name="password" placeholder="Contraseña" title="Introduzca su contraseña"/>
<i class="fas fa-key"></i>
<a href="#">Ha olvidado su contraseña?</a>
<button>
<i class="spinner"></i>
<span class="state">Iniciar sesión</span>
</button>
</form>
<footer><a target="blank" href="http://boudra.me/">Designed by boudra.me</a></footer>
</p>
</div>