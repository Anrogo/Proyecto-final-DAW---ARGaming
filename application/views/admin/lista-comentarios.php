<script type="text/javascript">
    function eliminar(id) {
        var ok = confirm("¿ Seguro de borrar este comentario ? ");
        if (!ok) {
            return false;
        } else {
            location.href = "/admin/eliminar-comentario/" + id;
        }
    }
</script>
<!--TABLA/LISTADO DE COMENTARIOS-->
<div class="container">
<div class="row mt-4">
    <div class="col-5 text-center">
      <h1 class="">Listado de comentarios</h1>
    </div>
    <div class="col-3 text-center">
      <a href="/admin/nuevo-comentario" class="btn btn-primary">Nuevo Comentario</a>
    </div>
    <div class="col-4 text-center">
      <form class="form-inline my-2 my-lg-0" action="/admin/buscar-comentario" method="post">
        <input class="form-control mr-sm-2" type="text" name="buscar" id="busqueda" value="<?php echo isset($busqueda) ? $busqueda : '' ?>" placeholder="Buscar...">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Búsqueda</button>
      </form>
    </div>
  </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <?php
                    if (isset($comentarios)) {

                    ?>
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">ID</th>
                                <th scope="col">Post(ID)</th>
                                <th scope="col">Usuario(ID)</th>
                                <th scope="col">Texto</th>
                                <th scope="col">Fecha / hora
                                <span class="">
                                        <a href="/admin/panel-control/comentarios/ordenar-creado/desc">
                                            <svg class="bi bi-arrow-down-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                                                <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                        </a>
                                        <span class="">
                                            <a href="/admin/panel-control/comentarios/ordenar-creado/asc">
                                                <svg class="bi bi-arrow-up-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path fill-rule="evenodd" d="M4.646 8.354a.5.5 0 0 0 .708 0L8 5.707l2.646 2.647a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 0 .708z" />
                                                    <path fill-rule="evenodd" d="M8 11.5a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-1 0v5a.5.5 0 0 0 .5.5z" />
                                                </svg>
                                            </a>
                                        </span>
                                </th>
                                <th scope="col">Responder</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                        foreach ($comentarios as $comentario) {

                            //Se procesan los datos recibidos
                            $id_comentario = $comentario['id_comentario'];
                            $id_post = $comentario['id_post'];
                            $id_usuario = $comentario['id_usuario'];
                            $texto = strlen($comentario['texto']) > 60 ? substr($comentario['texto'],0,60)."..." : $comentario['texto'];
                            //$fecha_hora = $comentario['creado'];

                            //formateo la fecha mediante varias funciones para que aparezca en formato "más español"
                            $fecha_hora = explode(" ", $comentario['creado']);
                            $fecha = implode("/", array_reverse(explode("-", $fecha_hora[0])));
                            $hora = $fecha_hora[1];

                            $titulo = $comentario['titulo'];
                            $username = $comentario['username'];
                            $slug = $comentario['slug'];


                            //Y se muestran en forma de tabla
                            echo "<tr id=\"" . $id_comentario . "\">
                            <td>" . $id_comentario . "</td>
                            <td><a href='/post/" . $id_post . "'>" . $titulo ."</a></td>
                            <td><a href='/usuario/" . $id_usuario . "'>" . $username ."</a></td>
                            <td class=\"col-3 small\">" . $texto . "</td>
                            <td class=\"small\">" . $fecha . " - " . $hora . " </td>
                            <td><a href=\"/admin/responder-comentario/" . $comentario['id_comentario'] . "\"><img src=\"/images/edit.png\" width=20px></a></td>
                            <td><a href=\"#\" OnClick=\"eliminar(" . $comentario['id_comentario'] . ")\"><img src=\"/images/delete.svg\" width=20px></a></td>
                            </tr>";
                        }
                    } else {
                        echo "Algo ha fallado al obtener el listado... Disculpe las molestias";
                    }
                        ?>
                        </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- /.row -->

</div>