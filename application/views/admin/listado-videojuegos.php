<!--TABLA/LISTADO DE VIDEOJUEGOS-->
<div class="container">
    <div class="row mt-4">
        <div class="col-5 text-center">
            <h1 class="">Listado de videojuegos</h1>
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
                    if (isset($juegos)) {

                    ?>
                        <thead>
                            <tr class="table-primary">
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

                            //Se procesan los datos recibidos
                            $id = $juego['id'];
                            $titulo = $juego['title'];
                            $snippet = $juego['snippet'];
                            $url = $juego['url'];

                            //Y se muestran en forma de lista
                            echo "<tr id=\"" . $id . "\">
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