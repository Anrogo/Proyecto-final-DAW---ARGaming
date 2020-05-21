<!--TABLA/LISTADO DE VIDEOJUEGOS-->
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <caption class="text-center">
                        Listado de videojuegos
                    </caption>
                    <?php
                    if (isset($juegos)) {
                        
                    ?>
                            <thead class="thead-dark">
                                <tr>
                                    <th class="th-sm">Activo</th>
                                    <th class="th-sm">ID</th>
                                    <th class="th-sm">Título</th>
                                    <th class="th-sm">Descripción</th>
                                    <th class="th-sm">URL</th>
                                    <th class="th-sm">Etiquetas</th>
                                </tr>
                            </thead>
                            <tbody>

                        <?php
                        foreach ($juegos as $juego) {
                            /*
                            echo '<pre>';
                            print_r($juego);
                            echo '</pre>';
                        */
                            //Se procesan los datos recibidos
                            $id = $juego['id'];
                            $titulo = $juego['title'];
                            $snippet = $juego['snippet'];
                            $url = $juego['url'];

                            //Y se muestran en forma de lista
                            echo "<tr id=\"" . $id . "\">
                        <td><input type=\"checkbox\" name=\"activo\" id=\"activo\" checked></td>
                        <td>" . $id . "</td>
                        <td>" . $titulo . "</td>
                        <td>" . $snippet . " </td>
                        <td><a href=\"" . $url . "\">Pulsa para ver más información.</a> 
                        </td><td></td></tr>";
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