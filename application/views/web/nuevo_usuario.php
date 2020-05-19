<div class="container mt-5">
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <span class="font-italic">Nuevo usuario</span>
                </div>
                <div class="card-body">
                    <form id="form_registro" action="#" method="POST">
                        <?php //echo validation_errors();
                        ?>

                        <div class="form-group">
                            <label for="nombre">Nombre de usuario</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?php echo set_value('username'); ?>">
                            <?php echo form_error('username', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo set_value('nombre'); ?>">
                            <?php echo form_error('nombre', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?php echo set_value('apellidos'); ?>">
                            <?php echo form_error('apellidos', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Correo</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email'); ?>">
                            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="form-row">
                            <div class="col-6 col-md-3">
                                <label for="nombre">Crea una contraseña</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="password" name="password" id="password" class="form-control" value="<?php echo set_value('password'); ?>">
                            </div>
                            <!--<i class="fas fa-eye"></i>-->
                            <div class="col-3 mt-1">
                                <span id="ver-pass" class="btn btn-outline-secondary" title="Mostrar contraseña">Mostrar</span>
                            </div>
                            <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="form-row mt-1 mb-2">
                            <div class="col-6 col-md-3">
                                <label for="nombre">Confirmar contraseña</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="password" name="password_confirm" id="password_confirm" class="form-control" value="<?php echo set_value('password_confirm'); ?>">
                            </div>
                            <?php echo form_error('password_confirm', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="radio">
                            <input type="hidden" name="estado" value="1" checked>
                            <input type="hidden" name="rol" value="0" checked>
                        </div>
                        <input type="submit" value="Completar registro" id="submit" class="btn btn-primary">
                    </form>
                    <div class="text-center">
                        <a href="/" class="text-black">Cancelar y volver a la página de inicio</a>
                    </div>
                </div>
            </div>
            <br>
            <script type="text/javascript">
                window.addEventListener("load", cargaPagina);

                function cargaPagina() {
                    var btn = document.getElementById("ver-pass").addEventListener("click", mostrarPassword);
                }

                function mostrarPassword() {
                    document.getElementById("password").type = "text";
                }
            </script>
        </div>
    </div>
</div>