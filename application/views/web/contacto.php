<div class="container mt-5">
<?php
    if(isset($mensaje))
    {
?>
    <div class="row justify-content-center">
        <div class="col-10">
        <p class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php
                        echo $mensaje;
                    ?>
        </p>
        </div>
    </div>
<?php
    }
?>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <span class="font-italic">Contáctenos</span>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="#" method="post">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="nombre" class="sr-only">Nombre de usuario</label>
                                    <input id="username" name="username" type="text" placeholder="Su nombre de usuario, o el nombre que desee, si no está registrado" class="form-control input" value="<?php echo set_value('username'); ?>" autofocus>
                                    <?php
                                    echo form_error('username', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                    </svg>', '</div>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                <label for="email" class="sr-only">Correo</label>
                                    <input id="email" name="email" type="text" placeholder="Dirección de correo electrónico para poder responderle" class="form-control input" value="<?php echo set_value('email'); ?>">
                                </div>
                                <?php
                                echo form_error('email', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                </svg>', '</div>'); ?>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                <label for="phone" class="sr-only">Teléfono</label>
                                    <input id="phone" name="phone" type="text" placeholder="Su número de teléfono (opcional)" class="form-control input" value="<?php echo set_value('phone'); ?>">
                                </div>
                                <?php
                                echo form_error('phone', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                </svg>', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="asunto" class="sr-only">Asunto</label>
                                    <input id="asunto" name="asunto" type="text" placeholder="Asunto del mensaje" class="form-control input" value="<?php echo set_value('asunto'); ?>">
                                </div>
                                <?php
                                echo form_error('asunto', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                </svg>', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                <label for="mensaje" class="sr-only">Mensaje</label>
                                    <textarea class="form-control input" id="mensaje" name="mensaje" placeholder="Introduzca aquí el mensaje que quiera transmitirnos. Tendrá nuestra respuesta lo antes posible! Gracias &#128540;" rows="7"><?php echo set_value('mensaje'); ?></textarea>
                                </div>
                                <?php
                                echo form_error('mensaje', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                </svg>', '</div>'); ?>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <div class="text-center cancelar">
                        <a href="/" class="text-black">Cancelar y volver a la página de inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container -->