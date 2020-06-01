<script type="text/javascript">
    function eliminar(id) {
        var ok = confirm("¿ Seguro de borrar este post ? ");
        if (!ok) {
            return false;
        } else {
            location.href = "/admin/eliminar-post/" + id;
        }
    }
</script>
<!--TABLA/LISTADO DE POST-->
<div class="container">
<div class="row mt-4">
    <div class="col-5 text-center">
      <h1 class="">Listado de posts</h1>
    </div>
    <div class="col-3 text-center">
      <a href="/admin/nuevo-post" class="btn btn-primary">Nuevo Post</a>
    </div>
    <div class="col-4 text-center">
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Busqueda...">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
      </form>
    </div>
  </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <?php
                    if (isset($posts)) {

                    ?>
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">Imagen</th>
                                <th scope="col">Título</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Última modificación</th>
                                <th scope="col">Abierto</th>
                                <th scope="col">Visitas</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                        foreach ($posts as $post) {

                            //Se filtran algunos valores clave
                            if ($post['estado'] == "1") {
                                $abierto = "<img src='/images/activo.png'  width=20px>";
                            } else {
                                $abierto = "<img src='/images/no_activo.png' width=20px>";
                            }

                            //Se procesan los datos recibidos
                            $id = $post['id_post'];
                            $imagen = $post['imagen_post'];
                            $titulo = $post['titulo'];
                            $contenido = strlen($post['contenido']) > 60 ? substr($post['contenido'],0,60)."..." : $post['contenido'];
                            $modificado = $post['modificado'];
                            $link = $post['slug'];
                            $visitas = $post['visitas'] == 0 ? '1' : $visitas;

                            //Y se muestran en forma de tabla
                            echo "<tr id=\"" . $id . "\">
                            <td><img src=\"/images/". $imagen ."\"  width=\"200px\"></td>
                            <td><a href=\"/post/" . $id . "\">" . $titulo . "</a></td>
                            <td>" . $contenido . " </td>
                            <td><a href=\"post/" . $id . "\">$link</a></td>
                            <td>" . $modificado . " </td>
                            <td>" . $abierto . "</td>
                            <td>" . $visitas . "</td>
                            <td><a href=\"/admin/editar-post/" . $id . "\"><img src=\"/images/edit.png\" width=20px></a></td>
                            <td><a href=\"#\" OnClick=\"eliminar(" . $id . ")\"><img src=\"/images/delete.svg\" width=20px></a></td>
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