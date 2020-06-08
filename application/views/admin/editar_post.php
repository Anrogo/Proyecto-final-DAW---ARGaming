<?php 
//Recorre el array y como solo hay un registro (el del post seleccionado), se muestran sus datos en los campos de más abajo
foreach($posts as $post){
    if (  isset($post['estado']) &&  $post['estado'] == "1")//Si tiene estado y este es 1 entonces debemos marcar la opción predeterminada como "activo"
  {
    $activo1 =  "Activo";
  }
  else
  {
    $activo0 =  "Cerrado";
  }
}
?>
<div class="container">
    <div class="row">
        <div class="col-10">
            <br>
            <div class="card">
                <div class="card-header">
                    <span class="font-italic text-uppercase"><?php echo "(ID: ".$post['id_post'].") - ".$post['titulo']; ?></span>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        <input type="hidden" name="id_post" id="id_post" value="<?php echo $post['id_post']; ?>">
                        <div class="form-group">
                            <label for="imagen">Imagen del post</label>
                            <div class="mb-2">
                                    <img class="img-fluid" src="/images/<?php echo $post['imagen_post'] ?>" alt="Foto post">
                            </div>
                            <input class="form-control" type="text" placeholder="<?php echo $post['imagen_post'] ?>" readonly>
                            <input type="file" class="form-control-file" name="imagen_post" id="imagen_post" accept="image/png, .jpeg, .jpg, image/gif">
                            <?php
                            echo form_error('imagen_post', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="usuario">Creado por</label>
                            <select name="id_usuario" id="id_usuario" class="form-control">
                                <option value="0">Seleccionar el usuario</option>
                                <?php
                                foreach( $usuarios as $usuario ){

                                    $id_usuario = $usuario['id_usuario'];
                                    $username = $usuario['username'];
                                    $selected = $post['id_usuario'] == $id_usuario ? 'selected' : '';
                                    echo '<option value="'.$id_usuario.'" '.$selected.'>'.$username.'</option>';
                                }
                            ?>
                            </select>
                            <?php
                            echo form_error('id_usuario', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título del post</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $post['titulo']; ?>">
                            <?php
                            echo form_error('titulo', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); 
                            echo isset($error_titulo) ? '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>'.$error_titulo.'</div>' : '' ;
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug / meta descripción</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="<?php echo $post['slug']; ?>">
                            <?php
                            echo form_error('slug', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); 
                            echo isset($error_slug) ? '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>'.$error_slug.'</div>' : '' ;
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="contenido">Contenido del post</label>
                            <textarea name="contenido" id="contenido" class="form-control" cols="30" rows="15"><?php echo  $post['contenido']; ?></textarea>
                            <?php
                            echo form_error('contenido', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); 
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="creacion">Fecha de creación</label>
                            <input class="form-control" type="text" value="<?php echo $post['creado'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="modificación">Última modificación</label>
                            <input class="form-control" type="text" value="<?php echo $post['modificado'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="visitas">Visitas</label>
                            <input type="number" name="visitas" id="visitas" class="form-control" value="<?php echo $post['visitas']; ?>" min="0" max="999999">
                            <?php
                            echo form_error('visitas', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado del post</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="1" <?php echo isset($activo1) ? $activo1 : ""; ?>>Activo</option>
                                <option value="0" <?php echo isset($activo0) ? $activo0 : ""; ?>>Cerrado</option>
                            </select>
                            <?php
                            echo form_error('estado', '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>', '</div>'); ?>
                        </div>
                        <input type="submit" value="Guardar post" id="submit" class="btn btn-primary">
                        <a href="/admin/panel-control/post" class="btn btn-secondary">Volver</a>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

