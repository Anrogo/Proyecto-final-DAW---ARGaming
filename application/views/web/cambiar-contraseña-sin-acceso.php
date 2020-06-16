<div class="container">
    <div class="row justify-content-center top-100">
        <div class="col-10">
            <br>
            <div class="card">
                <div class="card-header">
                    <h4>No recuerdo mi contraseña, ¿alguna solución?</h4>
                </div>
                <div class="card-body">
                    <form action="/cambiar-password" method="POST">
                        <div class="form-row">
                            <div class="col-12">
                                <label for="nombre">Puedes decirnos tu correo para que te mandemos una nueva contraseña</label>
                            </div>
                            <div class="col-12">
                                <input type="text" name="email" id="email" class="form-control input" value="<?php echo set_value('email'); ?>" required>
                            </div>
                            <?php
                                echo form_error('email', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                </svg>', '</div>');
                                echo isset($error) ? '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                </svg>'.$error.'</div>' : '';
                            ?>
                        </div>
                        <input type="submit" value="Enviar" class="btn btn-outline-info mt-2">
                        <a href="/" class="btn btn-secondary mt-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>