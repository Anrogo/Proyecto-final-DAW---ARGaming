<script type="text/javascript">
  function eliminar(id) {
    var ok = confirm("¿ Seguro de borrar este usuario ? ");
    if (!ok) {
      return false;
    } else {
      location.href = "/admin/eliminar-usuario/" + id;
    }
  }
</script>
<div class="container">
  <div class="row mt-4">
    <div class="col-12 col-md-5 text-center">
      <h1 class="">Listado de usuarios</h1>
    </div>
    <div class="col-12 col-md-3 text-center mt-2">
      <a href="/admin/nuevo-usuario" class="btn btn-primary">Nuevo Usuario</a>
    </div>
    <div class="col-12 col-md-4 text-center">
      <form class="form-inline my-2 my-lg-0" action="/admin/buscar-usuario" method="post">
        <input class="form-control mr-sm-2" type="text" name="buscar" id="busqueda" value="<?php echo isset($busqueda) ? $busqueda : '' ?>" placeholder="Buscar...">
        <button class="btn btn-primary my-2 my-sm-2" type="submit">Búsqueda</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 text-center">
      <?php
      if (isset($usuarios)) {
      ?>
        <table class="table table-responsive table-bordered table-striped table-hover">
          <thead>
            <tr class="table-primary">
              <th scope="col">ID</th>
              <th scope="col">Foto</th>
              <th scope="col">Username
                <span class="">
                  <a href="/admin/panel-control/usuarios/ordenar-username/desc">
                    <svg class="bi bi-arrow-down-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                      <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                      <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                  </a>
                </span>
                <span class="">
                  <a href="/admin/panel-control/usuarios/ordenar-username/asc">
                    <svg class="bi bi-arrow-up-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                      <path fill-rule="evenodd" d="M4.646 8.354a.5.5 0 0 0 .708 0L8 5.707l2.646 2.647a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 0 .708z" />
                      <path fill-rule="evenodd" d="M8 11.5a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-1 0v5a.5.5 0 0 0 .5.5z" />
                    </svg>
                  </a>
                </span>
              </th>
              <th scope="col">Email</th>
              <th scope="col">Nombre
                <span class="">
                  <a href="/admin/panel-control/usuarios/ordenar-nombre/desc">
                    <svg class="bi bi-arrow-down-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                      <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                      <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                  </a>
                </span>
                <span class="">
                  <a href="/admin/panel-control/usuarios/ordenar-nombre/asc">
                    <svg class="bi bi-arrow-up-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                      <path fill-rule="evenodd" d="M4.646 8.354a.5.5 0 0 0 .708 0L8 5.707l2.646 2.647a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 0 .708z" />
                      <path fill-rule="evenodd" d="M8 11.5a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-1 0v5a.5.5 0 0 0 .5.5z" />
                    </svg>
                  </a>
                </span>
              </th>
              <th scope="col">Apellidos</th>
              <th scope="col">Modificado
                <span class="">
                  <a href="/admin/panel-control/usuarios/ordenar-modificado/desc">
                    <svg class="bi bi-arrow-down-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                      <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                      <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                  </a>
                </span>
                <span class="">
                  <a href="/admin/panel-control/usuarios/ordenar-modificado/asc">
                    <svg class="bi bi-arrow-up-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                      <path fill-rule="evenodd" d="M4.646 8.354a.5.5 0 0 0 .708 0L8 5.707l2.646 2.647a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 0 .708z" />
                      <path fill-rule="evenodd" d="M8 11.5a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-1 0v5a.5.5 0 0 0 .5.5z" />
                    </svg>
                  </a>
                </span>
              </th>
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
                    <td>
                      <a href="/usuario/' . $usuario['id_usuario'] . '">
                        <div class="foto-perfil">
                          <img src="/images/fotos_perfil/' . ($usuario['imagen_perfil'] == null ? 'perfil-predeter.jpg' : $usuario['imagen_perfil']) . '" class="img-fluid" alt="Foto de perfil">
                        </div>
                      </a>
                    </td>
                    <td align=left><a href="/usuario/' . $usuario['id_usuario'] . '">' . $usuario['username'] . '</a></td>
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
        } else {
          echo isset($resultado) ? $resultado : '';
        }

          ?>


          </tbody>
        </table>
        <?php
        echo $pagination
        ?>
    </div>
  </div>

</div>