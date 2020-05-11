<div class="container">
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <span class="font-italic">Nuevo usuario</span>
                </div>
                <div class="card-body">
                    <form name="validate_form" action="/admin/registrar-usuario" method="POST">
                        <div class="form-group">
                            <label for="imagen">Imagen de perfil</label>
                            <input class="form-control" type="text" placeholder="image1.jpg" readonly>
                            <input type="file" class="form-control-file" name="imagen" id="imagen" accept="image/png, .jpeg, .jpg, image/gif">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre de usuario</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Correo</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Crea una contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" minlength="6" pattern="[A-Za-z0-9]+" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Confirmar contraseña</label>
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control" minlength="6" required>
                        </div>
                        <div class="radio">
                            <input type="hidden" name="estado" value="1" checked>
                        </div>
                        <input type="submit" value="Guardar cambios" id="submit" class="btn btn-outline-info">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#validate_form').on('submit',function(){
            alert($('#password').text());
        });
    });
</script>