<?php
//Recorre el array y como solo hay un registro (el del usuario seleccionado), se muestran sus datos en los campos de más abajo
foreach ($usuarios as $usuario) {
    if (isset($usuario['estado']) &&  $usuario['estado'] == "1") //Si tiene estado y este es 1 entonces debemos marcar la opción predeterminada como "activo"
    {
        $activo1 =  "Checked";
    } else {
        $activo0 =  "Checked";
    }
    if (isset($usuario['rol']) &&  $usuario['rol'] == "1") //De la misma manera, si tiene un rol que será 0 - usuario básico ó 1 - administrador, se comprueba y asigna Selected al input
    {
        $rol1 =  "Selected";
    } else {
        $rol0 =  "Selected";
    }
}
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
                            <input class="form-control" type="text" placeholder="" readonly>
                            <input type="file" class="form-control-file" name="imagen" id="imagen" accept="image/png, .jpeg, .jpg, image/gif">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre de usuario</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?php echo $usuario['username'] ?>">
                            <?php
                            echo form_error('username', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); ?>
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
                            </svg>', '</div>'); ?>
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
                        <div class="radio">
                            <label for="activo" class="radio-inline"><input type="radio" name="estado" value="1" <?php echo isset($activo1) ? $activo1 : ""; ?>> Activo </label>
                        </div>
                        <div class="radio">
                            <label for="inactivo" class="radio-inline"><input type="radio" name="estado" value="0" <?php echo isset($activo0) ? $activo0 : ""; ?>> Inactivo </label>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Rol del usuario</label>
                            <select name="rol" id="rol" class="form-control">
                                <option value="0" <?php echo isset($rol0) ? $rol0 : ""; ?>>Estándar</option>
                                <option value="1" <?php echo isset($rol1) ? $rol1 : ""; ?>>Administrador</option>
                            </select>
                            <?php
                            echo form_error('rol', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); ?>
                        </div>
                        <input type="submit" value="Guardar cambios" class="btn btn-outline-info">
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>