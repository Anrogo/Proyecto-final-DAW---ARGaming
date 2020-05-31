    <div class="container">
        <h1> Bienvenido/a <?php echo $nombre ?> </h1>
        <img class="img-fluid" src="/images/fotos_perfil/<?php echo $imagen_perfil ?>" width="100px" alt="Foto perfil">
        <p>
            Estás logueado como <?php echo $rol ?>. Pulsa aquí para:
            <a href="/usuario/cerrar-sesion"> Cerrar sesión </a></p>
        <p>
            Si quieres modificar tu perfil, pulsa
            <a href="/usuario/editar-perfil/<?php echo $id ?>">aquí</a>
        </p>
    </div>