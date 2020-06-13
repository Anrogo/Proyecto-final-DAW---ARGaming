<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
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
                <div class="card-body">
                    <table class="table table-bordered table-responsive-md">
                        <tr>
                            <th class="col-3 list-group-item-success">Nombre</th>
                            <td><?php echo $nombre ?></td>
                        </tr>
                        <tr>
                            <th class="col-3 col-md-3 list-group-item-success">Apellidos</th>
                            <td><?php echo $apellidos ?></td>
                        </tr>
                        <tr>
                            <th class="col-3 col-md-3 list-group-item-success">Correo</th>
                            <td><?php echo $email ?></td>
                        </tr>
                        <tr>
                            <th class="col-3 col-md-3 list-group-item-success">Rol</th>
                            <td><?php echo $rol ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
        if (isset($posts)) {

    ?>
    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Posts creados por <?php echo $username ?></h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    
                        <thead class="thead-dark">
                            <tr>
                                <th class="th-sm">Imagen</th>
                                <th class="th-sm">Título</th>
                                <th class="th-sm">Creador</th>
                                <th class="th-sm">Descripción</th>
                                <th class="th-sm">Meta descripción</th>
                                <th class="th-sm">Última modificación</th>
                                <th class="th-sm">Visitas</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                        foreach ($posts as $post) {

                            //Se procesan los datos recibidos
                            $id = $post['id_post'];
                            $titulo = $post['titulo'];
                            $contenido = strlen($post['contenido']) > 60 ? substr($post['contenido'], 0, 60) . "..." : $post['contenido'];
                            $imagen = $post['imagen_post'];
                            $modificado = $post['modificado'];
                            $activo = $post['estado'] == 1 ? 'Activo' : 'Cerrado';
                            $link = $post['slug'];
                            $visitas = $post['visitas'];
                            $username = $post['username'];
                            $id_usuario = $post['id_usuario'];
                            
                            //Y se muestran en forma de tabla
                            echo "<tr id=\"" . $id . "\">
                            <td><img src=\"/images/" . $imagen . "\"  width=\"200px\"></td>
                            <td><a href=\"/post/" . $id . "\">" . $titulo . "</a></td>
                            <td><a href=\"/usuario/" . $id_usuario . "\">" . $username . "</a></td>
                            <td>" . $contenido . " </td>
                            <td><a href=\"post/" . $id . "\">$link</a></td>
                            <td>" . $modificado . " </td>
                            <td class=\"text-center\">" . $visitas . "</td>
                            </tr>";
                        }
                    } else {
                        echo isset($resultado) ? $resultado : '';
                    }
                        ?>
                        </tbody>
                </table>

            </div>
        </>
    </div>
</div>