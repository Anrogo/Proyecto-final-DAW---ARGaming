<?php 
//Recorre el array y como solo hay un registro (el del usuario seleccionado), se muestran sus datos en los campos demás abajo
foreach($usuarios as $usuario){
    if (  isset( $usuario['estado']) &&  $usuario['estado'] == "1")//Si tiene estado y este es 1 entonces debemos marcar la opción predeterminada como "activo"
  {
    $activo1 =  "Checked";
  }
  else
  {
    $activo0 =  "Checked";
  }
  if (  isset( $usuario['rol']) &&  $usuario['rol'] == "1")//De la misma manera, si tiene un rol que será 0 - usuario básico ó 1 - administrador, se comprueba y asigna Selected al input
  {
    $rol1 =  "Selected";
  }
  else
  {
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
                    <span class="font-italic text-uppercase"><?php echo "(ID: ".$usuario['id_usuario'].") - ".$usuario['username']; ?></span>
                </div>
                <div class="card-body">
                    <form action="/actualizar-usuario" method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo $usuario['id_usuario']; ?>">
                        <div class="form-group">
                            <label for="imagen">Imagen de perfil</label>
                            <input class="form-control" type="text" placeholder="" readonly>
                            <input type="file" class="form-control-file" name="imagen" id="imagen" accept="image/png, .jpeg, .jpg, image/gif">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre de usuario</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?php echo $usuario['username']?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $usuario['nombre']?>">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?php echo $usuario['apellidos']?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Correo</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $usuario['email']?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Fecha de creación</label>
                            <input class="form-control" type="text" placeholder="08/05/2020 18:30:27" readonly>
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
                                <option value="0" <?php echo isset($rol0) ? $rol0 : ""; ?>>Básico</option>
                                <option value="1" <?php echo isset($rol1) ? $rol1 : ""; ?>>Administrador</option>
                            </select>
                        </div>
                        <input type="submit" value="Guardar cambios" class="btn btn-outline-info">
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

