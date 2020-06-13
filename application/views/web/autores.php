<!--TABLA/LISTADO DE POST-->
<div class="container">
    <div class="row mt-4">
        <div class="col-12 col-md-5 text-center">
            <h1 class="">Listado de autores</h1>
        </div>
    </div>
    <div class="col-md-12 text-center mt-2">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <?php
                if (isset($autores)) {

                ?>
                    <thead class="thead-dark">
                        <tr>
                            <th class="th-sm">Usuario</th>
                            <th class="th-sm">Post creados</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                    foreach ($autores as $autor) {

                        //Se procesan los datos recibidos
                        $username = $autor['username'];
                        $id_usuario = $autor['id_usuario'];
                        $numero_post = $autor['numero_post'];
                        //Y se muestran en forma de tabla
                        echo "<tr>
                            <td><a href=\"/usuario/" . $id_usuario . "\">" . $username . "</a></td>
                            <td>" . $numero_post . " </td>
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
<!-- /.row -->

</div>