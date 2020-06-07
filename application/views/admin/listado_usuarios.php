<script type="text/javascript">
  
  function eliminar( id )
  {
    var ok = confirm( "¿ Seguro de borrar este usuario ? ");
    if ( !ok)
    {
      return false;
    }
    else
    {
      location.href = "/admin/eliminar-usuario/" + id;
    }
  }

</script>
<div class="container">
  <div class="row mt-4">
    <div class="col-5 text-center">
      <h1 class="">Listado de usuarios</h1>
    </div>
    <div class="col-3 text-center">
      <a href="/admin/nuevo-usuario" class="btn btn-primary">Nuevo Usuario</a>
    </div>
    <div class="col-4 text-center">
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Buscar...">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Busqueda</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 text-center">
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr class="table-primary">
            <th scope="col">ID</th>
            <th scope="col">Foto</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Modificado</th>
            <th scope="col">Admin</th>
            <th scope="col">Activo</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody>

          <?php

          foreach ($usuarios as $usuario) {
            if ($usuario['estado'] == "1") {
              $activo = "<img src='/images/activo.png'  width=20px>";
            } else {
              $activo = "<img src='/images/no_activo.png' width=20px>";
            }

            if ($usuario['rol'] == "1") {
              $admin = "Sí";
            } else {
              $admin = "No";
            }


            echo '<tr>
                    <th scope="row">' . $usuario['id_usuario'] . '</th>
                    <td><img src="/images/fotos_perfil/' . $usuario['imagen_perfil'] . '" class="img-fluid" alt="Foto de perfil"></td>
                    <td align=left>' . $usuario['username'] . '</td>
                    <td align=left>' . $usuario['email'] . '</td>
                    <td align=left>' . $usuario['nombre'] . '</td>
                    <td align=left>' . $usuario['apellidos'] . '</td>
                    <td align=left>' . $usuario['modificado'] . '</td>
                    <td>' . $admin . '</td>
                    <td>' . $activo . '</td>
                    <td><a href="/admin/editar-usuario/' . $usuario['id_usuario'] . '"><img src="/images/edit.png" width=20px></a></td>
                    <td><a href="#" OnClick="eliminar(' . $usuario['id_usuario'] . ')"><img src="/images/delete.svg"  width=20px></a></td>
                  </tr>';
          }

          ?>


        </tbody>
      </table>

    </div>
  </div>

</div>