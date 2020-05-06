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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">Titulo</th>
                        <th scope="col" class="text-center">Fecha y hora</th>
                        <th scope="col" class="text-center">Activo</th>
                        <th scope="col" class="text-center">Editar</th>
                        <th scope="col" class="text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    if (!empty($posts)) {
                        foreach ($posts as $post) {
                            if ($post['enabled'] == "1") {
                                $enabled = "<img src='/images/activo.png'  width=20px>";
                            } else {
                                $enabled = "<img src='/images/no_activo.png' width=20px>";
                            }


                            echo '<tr>
                                <th scope="row">' . $post['id'] . '</th>
                                <td>' . $post['title'] . '</td>
                                <td>' . date("d/m/Y H:i:s", strtotime($post['created'])) . '</td>
                                <td>' . $enabled . '</td>
                                <td><a href="/edit/' . $post['id'] . '"><img src="/images/edit.png" width=20px></a></td>
                                <td><a href="#" OnClick="delete_post(' . $post['id'] . ')"><img src="/images/delete_2.png"  width=20px></a></td>
                            </tr>';
                        }
                    }
                    ?>


                </tbody>
            </table>

        </div>

    </div>
</div>