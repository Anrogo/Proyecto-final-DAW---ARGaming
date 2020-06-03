<?php
//Recorre el array y como solo hay un registro (el del usuario seleccionado), se muestran sus datos en los campos demás abajo
foreach ($usuarios as $usuario) {

?>
    <div class="container">
        <div class="row">
            <div class="col-10">
                <br>
                <div class="card">
                    <div class="card-header">
                        <span class="font-italic text-uppercase"><?php echo "(ID: " . $usuario['id_usuario'] . ") - " . $usuario['username']; ?></span>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            <input type="hidden" name="id" id="id" value="<?php echo $usuario['id_usuario']; ?>">
                            <div class="form-group">
                                <label for="imagen">Imagen de perfil</label>
                                <div class="foto-perfil mb-2">
                                    <img class="img-fluid" src="/images/fotos_perfil/<?php echo $usuario['imagen_perfil'] ?>" alt="Foto perfil">
                                </div>
                                <input class="form-control" type="text" placeholder="<?php echo $usuario['imagen_perfil'] ?>" readonly>
                                <input type="file" class="form-control-file" name="imagen_perfil" id="imagen_perfil" accept="image/png, .jpeg, .jpg, image/gif">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre de usuario</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $usuario['username'] ?>">
                                <?php
                                echo form_error('username', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); 
                            echo isset($error_username) ? '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>'.$error_username.'</div>' : '' ;
                            ?>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $usuario['nombre'] ?>">
                                <?php
                                echo form_error('nombre', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?php echo $usuario['apellidos'] ?>">
                                <?php
                                echo form_error('apellidos', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Correo</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?php echo $usuario['email'] ?>">
                                <?php
                                echo form_error('email', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); 
                            echo isset($error_correo) ? '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>'.$error_correo.'</div>' : '' ;
                            ?>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-6">
                                    <label for="titulo">¿Necesita una nueva contraseña?</label>
                                </div>
                                <div class="col-12 col-md-6">
                                <span class="btn btn-secondary"><a href="/usuario/cambiar-password/<?php echo $usuario['id_usuario'] ?>" target="_blank" class="text-white">Actualizar contraseña</a></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Fecha de creación</label>
                                <input class="form-control" type="text" value="<?php echo $usuario['creado'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Tipo de usuario</label>
                                <input type="text" name="rol" id="rol" class="form-control" value="<?php echo $usuario['rol'] == '0' ? 'Usuario estándar' : 'Usuario administrador'; ?>" readonly>
                            </div>
                            <input type="submit" value="Guardar cambios" class="btn btn-outline-info">
                        </form>
                    </div>
                <?php
            }
                ?>
                </div>
                <br>
                <script src="/bootstrap/js/jquery-3.4.1.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#ver-pass').on('click', function() {
                            $('#password').attr('type', 'text');
                            if ($('#ocultar-pass').length == 0) {
                                $('#botones-pass').append($('<span>').attr("class", "btn btn-outline-secondary").attr('id', 'ocultar-pass').text('Ocultar'));
                            }
                            $('#ocultar-pass').on('click', function() {
                                $('#password').attr('type', 'password');
                                $('#ocultar-pass').remove();
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>