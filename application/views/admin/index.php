<script type="text/javascript">
  
  function delete_post( id)
  {
    var ok = confirm( "¿ Seguro de borrar este post ? ");
    if ( !ok)
    {
      return false;
    }
    else
    {
      location.href = "/delete/" + id;
    }
  }

</script>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-lett">
            <h1 class="mt-5">Listado de posts</h1>
            </ul>
        </div>
    </div>
    <br><br>
    <a href="/new_post" class="btn btn-primary">Nuevo post</a>
    <br><br>
    <div class="row">
            
        <div class="col-lg-12 text-center">
            <?php
                if (isset($posts)) {

            ?>
            <table class="table">
                <thead>
                    <tr class="table-primary">
                                <th scope="col">Imagen</th>
                                <th scope="col">Título</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Última modificación</th>
                                <th scope="col">Abierto</th>
                                <th scope="col">Visitas</th>
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

                    //Y se muestran en forma de tabla
                    echo "<tr id=\"" . $id . "\">
                    <td><img src=\"/images/". $imagen ."\"  width=\"200px\"></td>
                    <td><a href=\"/post/" . $id . "\">" . $titulo . "</a></td>
                    <td>" . $contenido . " </td>
                    <td><a href=\"post/" . $id . "\">$link</a></td>
                    <td>" . $modificado . " </td>
                    <td>" . $abierto . "</td>
                    <td>" . $visitas . "</td>
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