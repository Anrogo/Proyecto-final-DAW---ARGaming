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
            <form class="form-inline my-2 my-lg-0" action="/admin/buscar-post" method="post">
                <input class="form-control mr-sm-2" type="text" name="buscar" id="busqueda" value="<?php echo isset($busqueda) ? $busqueda : '' ?>" placeholder="Buscar...">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Búsqueda</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 text-center">
            <?php
            if (isset($posts)) {

            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">Imagen</th>
                                <th scope="col">Título</th>
                                <th scope="col">Creador
                                    <span class="">
                                        <a href="/admin/panel-control/post/ordenar-username/desc">
                                            <svg class="bi bi-arrow-down-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                                                <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                        </a>
                                        <span class="">
                                            <a href="/admin/panel-control/post/ordenar-username/asc">
                                                <svg class="bi bi-arrow-up-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path fill-rule="evenodd" d="M4.646 8.354a.5.5 0 0 0 .708 0L8 5.707l2.646 2.647a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 0 .708z" />
                                                    <path fill-rule="evenodd" d="M8 11.5a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-1 0v5a.5.5 0 0 0 .5.5z" />
                                                </svg>
                                            </a>
                                        </span>
                                </th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Creado
                                    <span class="">
                                        <a href="/admin/panel-control/post/ordenar-creado/desc">
                                            <svg class="bi bi-arrow-down-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                                                <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                        </a>
                                        <span class="">
                                            <a href="/admin/panel-control/post/ordenar-creado/asc">
                                                <svg class="bi bi-arrow-up-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path fill-rule="evenodd" d="M4.646 8.354a.5.5 0 0 0 .708 0L8 5.707l2.646 2.647a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 0 .708z" />
                                                    <path fill-rule="evenodd" d="M8 11.5a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-1 0v5a.5.5 0 0 0 .5.5z" />
                                                </svg>
                                            </a>
                                        </span>
                                </th>
                                <th scope="col">Última modificación
                                    <span class="">
                                        <a href="/admin/panel-control/post/ordenar-modificado/desc">
                                            <svg class="bi bi-arrow-down-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                                                <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                        </a>
                                        <span class="">
                                            <a href="/admin/panel-control/post/ordenar-modificado/asc">
                                                <svg class="bi bi-arrow-up-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path fill-rule="evenodd" d="M4.646 8.354a.5.5 0 0 0 .708 0L8 5.707l2.646 2.647a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 0 .708z" />
                                                    <path fill-rule="evenodd" d="M8 11.5a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-1 0v5a.5.5 0 0 0 .5.5z" />
                                                </svg>
                                            </a>
                                        </span>
                                </th>
                                <th scope="col">Abierto</th>
                                <th scope="col">Visitas
                                    <span class="">
                                        <a href="/admin/panel-control/post/ordenar-visitas/desc">
                                            <svg class="bi bi-arrow-down-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z" />
                                                <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                        </a>
                                        <span class="">
                                            <a href="/admin/panel-control/post/ordenar-visitas/asc">
                                                <svg class="bi bi-arrow-up-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path fill-rule="evenodd" d="M4.646 8.354a.5.5 0 0 0 .708 0L8 5.707l2.646 2.647a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 0 .708z" />
                                                    <path fill-rule="evenodd" d="M8 11.5a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-1 0v5a.5.5 0 0 0 .5.5z" />
                                                </svg>
                                            </a>
                                        </span>
                                </th>
                                <th scope="col">Editar</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                        foreach ($posts as $post) {

                            //Se filtran algunos valores clave
                            if ($post['estado'] == "1") {
                                $abierto = "<img src='/images/activo.png'  width=\"20px\">";
                            } else {
                                $abierto = "<img src='/images/no_activo.png' width=\"20px\">";
                            }

                            //Se procesan los datos recibidos
                            $id = $post['id_post'];
                            $imagen = $post['imagen_post'];
                            $titulo = $post['titulo'];
                            $contenido = strlen($post['contenido']) > 60 ? substr($post['contenido'], 0, 60) . "..." : $post['contenido'];
                            $creado = $post['creado'];
                            $modificado = $post['modificado'];
                            $link = $post['slug'];
                            $visitas = $post['visitas'];
                            $username = $post['username'];
                            $id_usuario = $post['id_usuario'];

                            //Y se muestran en forma de tabla
                            echo "<tr id=\"" . $id . "\">
                            <td class=\" col-1\"><img src=\"/images/" . $imagen . "\" class=\"img-fluid\" width=\"440px\"></td>
                            <td><a href=\"/post/" . $id . "\">" . $titulo . "</a></td>
                            <td><a href=\"/usuario/" . $id_usuario . "\">" . $username . "</a></td>
                            <td class=\"col-2 small\">" . $contenido . " </td>
                            <td class=\" col-1 small\"><a href=\"post/" . $id . "\">$link</a></td>
                            <td class=\"col-1 small\">" . $creado . " </td>
                            <td class=\" col-1 small\">" . $modificado . " </td>
                            <td>" . $abierto . "</td>
                            <td>" . $visitas . "</td>
                            <td><a href=\"/admin/editar-post/" . $id . "\"><img src=\"/images/edit.png\" width=20px></a></td>
                            <td><a href=\"#\" OnClick=\"eliminar(" . $id . ")\"><img src=\"/images/delete.svg\" width=20px></a></td>
                            </tr>";
                        }
                    } else {
                        echo isset($resultado) ? $resultado : '';
                    }
                        ?>
                        </tbody>
                    </table>

                </div>
        </div>
    </div>
    <!-- /.row -->
</div>
</div>