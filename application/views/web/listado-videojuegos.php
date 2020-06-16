<!--TABLA/LISTADO DE VIDEOJUEGOS-->
<div class="container">
    <div class="row mt-4">
        <div class="col-5 text-center">
            <h1 class="">Listado de videojuegos</h1>
        </div>
        <div class="col-7 text-center">
            <form class="form-inline my-2 my-lg-0" action="/lista-juegos/buscar" method="post">
                <input class="form-control mr-sm-2 w-75" type="text" name="buscar" placeholder="Busqueda...">
                <button class="btn btn-primary my-2 my-sm-2" type="submit">Buscar</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <span class="small font-weight-bold text-right">Resultados encontrados: <?php echo $total ?></span>
        </div>
        <div class="col-md-12">
            <table class="table table-responsive table-striped table-hover table-bordered">
                <?php
                if (isset($juegos)) {

                ?>
                    <thead>
                        <tr class="table-primary">
                            <th class="th-sm">ID</th>
                            <th class="th-sm">Título</th>
                            <th class="th-sm">Descripción</th>
                            <th class="th-sm">URL</th>
                            <th class="th-sm">Etiqueta</th>
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
                        $etiqueta = isset($etiqueta) ? $etiqueta : 'Nada';

                        //Y se muestran en forma de lista
                        echo "<tr id=\"" . $id . "\">
                            <td>" . $id . "</td>
                            <td>" . $titulo . "</td>
                            <td>" . $snippet . " </td>
                            <td><a href=\"" . $url . "\">Pulsa para ver más información.</a> 
                            </td><td class=\"font-italic\">" . $etiqueta . "</td></tr>";
                    }
                } else {
                    echo "Algo ha fallado al obtener el listado... Disculpe las molestias";
                }
                    ?>
                    </tbody>
            </table>

        </div>
    </div>
    <!-- /.row -->
</div>