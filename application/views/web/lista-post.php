<!--TABLA/LISTADO DE POST-->
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
                                    <th class="th-sm">ID</th>
                                    <th class="th-sm">Título</th>
                                    <th class="th-sm">Descripción</th>
                                    <th class="th-sm">Slug</th>
                                    <th class="th-sm">Última modificación</th>
                                    <th class="th-sm">Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                        <?php
                        
                        foreach ($posts as $post) {

                            //Se procesan los datos recibidos
                            $id = $post['id_post'];
                            $titulo = $post['titulo'];
                            $contenido = $post['contenido'];
                            $imagen = $post['imagen_post'];
                            $modificado = $post['modificado'];
                            $activo = $post['estado'] == 1 ? 'Activo' : 'Cerrado';
                            $link = $post['slug'];
                            //Y se muestran en forma de lista
                            echo "<tr id=\"" . $id . "\">
                            <td class=\"col-1\">" . $id . "</td>
                            <td class=\"col-3\">" . $titulo . "</td>
                            <td class=\"col-3\">" . $contenido . " </td>
                            <td class=\"col-2\"><a href=\"post/" . $id . "\">$link</a></td>
                            <td class=\"col-2\">" . $modificado . " </td>
                            <td class=\"col-1\">" . $activo . "</td>
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