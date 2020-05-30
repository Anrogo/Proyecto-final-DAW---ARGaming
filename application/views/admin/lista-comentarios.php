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
<!--TABLA/LISTADO DE COMENTARIOS-->
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <?php
                    if (isset($posts)) {

                    ?>
                        <caption class="text-center">
                            Listado de post
                        </caption>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Imagen</th>
                                <th scope="col">Título</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Última modificación</th>
                                <th scope="col">Abierto</th>
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
                            $visitas = $post['visitas'];
                            //Y se muestran en forma de lista
                            echo "<tr id=\"" . $id . "\">
                            <td><img src=\"/images/". $imagen ."\"  width=\"200px\"></td>
                            <td>" . $titulo . "</td>
                            <td>" . $contenido . " </td>
                            <td><a href=\"post/" . $id . "\">$link</a></td>
                            <td>" . $modificado . " </td>
                            <td>" . $abierto . "</td>
                            <td>" . $visitas . "</td>
                            <td><a href=\"/editar-post/" . $post['id_post'] . "\"><img src=\"/images/edit.png\" width=20px></a></td>
                            <td><a href=\"#\" OnClick=\"eliminar(" . $post['id_post'] . ")\"><img src=\"/images/delete.svg\" width=20px></a></td>
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