<div class="container">
    <h1> Bienvenido/a <?php echo $nombre ?> </h1>
    <div class="foto-perfil">
        <img class="img-fluid" src="/images/fotos_perfil/<?php echo $imagen_perfil ?>" alt="Foto perfil">
    </div>
    <p>
        Estás logueado como <?php echo $rol ?>. Pulsa aquí para:
        <a href="usuario/cerrar-sesion"> Cerrar sesión </a></p>
    <p>
        Si quieres modificar tu perfil, pulsa
        <a href="usuario/editar-perfil/<?php echo $id ?>">aquí</a>
    </p>
</div>
<div class="container">
    <div class="row">
        <div class="col">

        </div>
    </div>
</div>