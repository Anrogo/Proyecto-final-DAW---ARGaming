<div class="container">
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <span class="font-italic">Nuevo usuario</span>
                </div>
                <div class="card-body">
                    <form id="form_registro" action="#" method="POST">
                        <?php echo validation_errors();
                        ?>

                        <span class="error" id="cont_error"></span>
                        <div class="form-group">
                            <label for="nombre">Nombre de usuario</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?php echo set_value('username'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo set_value('nombre'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?php echo set_value('apellidos'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Correo</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Crea una contraseña</label>
                            <input type="text" name="password" id="password" class="form-control" value="<?php echo set_value('password'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Confirmar contraseña</label>
                            <input type="text" name="password_confirm" id="password_confirm" class="form-control" value="<?php echo set_value('password_confirm'); ?>">
                        </div>
                        <div class="radio">
                            <input type="hidden" name="estado" value="1" checked>
                            <input type="hidden" name="rol" value="0" checked>
                        </div>
                        <input type="submit" value="Completar registro" id="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
