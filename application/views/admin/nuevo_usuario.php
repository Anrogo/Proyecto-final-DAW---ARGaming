<div class="container">
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <span class="font-italic">Nuevo usuario</span>
                </div>
                <div class="card-body">
                    <form action="/registrar" method="POST">
                        <div class="form-group">
                            <label for="imagen">Imagen de perfil</label>
                            <input class="form-control" type="text" placeholder="image1.jpg" readonly>
                            <input type="file" class="form-control-file" name="imagen" id="imagen" accept="image/png, .jpeg, .jpg, image/gif">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre de usuario</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Correo</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="radio">
                            <label for="activo" class="radio-inline"><input type="radio" name="estado" value="1" checked> Activo </label>
                        </div>
                        <div class="radio">
                            <label for="inactivo" class="radio-inline"><input type="radio" name="estado" value="0"> Inactivo </label>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Rol del usuario</label>
                            <select name="rol" id="rol" class="form-control">
                                <option value="0">Básico</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                        <input type="submit" value="Guardar cambios" class="btn btn-outline-info">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>