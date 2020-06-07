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
      <a href="/admin/nuevo-comentario" class="btn btn-primary">Nuevo comentario</a>
    </div>
    <div class="col-4 text-center">
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Busqueda...">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Buscar</button>
      </form>
    </div>
  </div>
    <div class="row">
        <div class="col-md-12">
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
                                <th scope="col">Fecha / hora</th>
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

                            $username = $comentario['username'];
                            $slug = $comentario['slug'];


                            //Y se muestran en forma de tabla
                            echo "<tr id=\"" . $id_comentario . "\">
                            <td>" . $id_comentario . "</td>
                            <td><a href='/post/" . $id_post . "'>" . $slug ."</a></td>
                            <td><a href='/usuario/" . $id_usuario . "'>" . $username ."</a></td>
                            <td class=\"col-3\">" . $texto . "</td>
                            <td>" . $fecha . " - " . $hora . " </td>
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