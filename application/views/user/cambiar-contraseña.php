<?php 
//Recorre el array y como solo hay un registro (el del usuario seleccionado)
foreach($usuarios as $usuario){
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
                            <div class="form-row">
                                <div class="col-6 col-md-3">
                                    <label for="nombre">Crea una contraseña</label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <!--<i class="fas fa-eye"></i>-->
                                <div class="col-3 mt-1 mt-md-0" id="botones-pass">
                                    <span id="ver-pass" class="btn btn-outline-secondary" title="Mostrar contraseña"><i class="fas fa-eye"></i></span>
                                </div>
                                <?php
                                echo form_error('password', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); ?>
                            </div>
                            <div class="form-row mt-1 mb-2">
                                <div class="col-6 col-md-3">
                                    <label for="nombre">Confirmar contraseña</label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                                </div>
                                <div class="col-3 mt-1 mt-md-0" id="botones-pass-conf">
                                    <span id="ver-pass-conf" class="btn btn-outline-secondary" title="Mostrar contraseña"><i class="fas fa-eye"></i></span>
                                </div>
                                <?php
                                echo form_error('password_confirm', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); ?>
                            </div>
                            <input type="submit" value="Guardar cambios" class="btn btn-outline-info">
                            <a href="/" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <?php 
            }
            ?>
            <script src="/bootstrap/js/jquery-3.4.1.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#ver-pass').on('click', function() {
                        $('#password').attr('type', 'text');
                        if ($('#ocultar-pass').length == 0) {
                            $('#botones-pass').append($('<span>').attr("class", "btn btn-outline-secondary").attr('id', 'ocultar-pass').attr('title','Ocultar contraseña').append('<i class="fas fa-eye-slash"></i>'));
                        }
                        $('#ocultar-pass').on('click', function() {
                            $('#password').attr('type', 'password');
                            $('#ocultar-pass').remove();
                        });
                    });
                    $('#ver-pass-conf').on('click', function() {
                        $('#password_confirm').attr('type', 'text');
                        if ($('#ocultar-pass-conf').length == 0) {
                            $('#botones-pass-conf').append($('<span>').attr("class", "btn btn-outline-secondary").attr('id', 'ocultar-pass-conf').attr('title','Ocultar contraseña').append('<i class="fas fa-eye-slash"></i>'));
                        }
                        $('#ocultar-pass-conf').on('click', function() {
                            $('#password_confirm').attr('type', 'password');
                            $('#ocultar-pass-conf').remove();
                        });
                    });
                });
            </script>
        </div>
    </div>
    </div>