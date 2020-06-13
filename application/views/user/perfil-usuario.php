<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php echo $username ?></h3>
                </div>
                <div class="row">
                    <div class="col-6 col-md-4">
                        <div class="foto-perfil mt-2 ml-3">
                            <img src="/images/fotos_perfil/<?php echo $imagen_perfil ?>" class="img-fluid" alt="Foto-perfil">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 pull-right mt-3 text-center">
                        <a href="usuario/editar-perfil/<?php echo $id_usuario ?>" class="btn btn-outline-info">Editar perfil</a>
                    </div>
                    <div class="col-12 col-md-4 pull-right mt-3 text-center">
                        <a href="usuario/cerrar-sesion" class="btn btn-outline-secondary">Cerrar sesión</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <tr>
                            <th class="col-3 list-group-item-success">Nombre</th>
                            <td><?php echo $nombre ?></td>
                        </tr>
                        <tr>
                            <th class="col-12 col-md-3 list-group-item-success">Apellidos</th>
                            <td><?php echo $apellidos ?></td>
                        </tr>
                        <tr>
                            <th class="col-12 col-md-3 list-group-item-success">Correo</th>
                            <td><?php echo $email ?></td>
                        </tr>
                        <tr>
                            <th class="col-12 col-md-3 list-group-item-success">Rol</th>
                            <td><?php echo $rol ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>