<?php

    # recogemos los valores que nos envia el controlador
  ( isset( $post[0]['id']) ? $post_id =  $post[0]['id'] : $post_id = '');
  ( isset( $post[0]['author_id']) ? $author_id =  $post[0]['author_id'] : $author_id = '');
  ( isset( $post[0]['category_id']) ? $category_id =  $post[0]['category_id'] : $category_id = '');
  ( isset( $post[0]['title']) ? $title =  $post[0]['title'] : $title = '');
  ( isset( $post[0]['brief']) ? $brief =  $post[0]['brief'] : $brief = '');
  ( isset( $post[0]['text']) ? $text =  $post[0]['text'] : $text = '');
  ( isset( $post[0]['slug']) ? $slug =  $post[0]['slug'] : $slug = '');
  ( isset( $post[0]['created']) ? $created =  $post[0]['created'] : $created = '');

  if (  isset( $post[0]['enabled']) &&  $post[0]['enabled'] == "1")
  {
    $enabled =  "Checked";
  }
  else
  {
    $enabled =  "";
  }

  $nivel_1 = $nivel_2 = $nivel_3 = "";

  switch ( $post[0]['category_id']) {
    case '1':
      $nivel_1 = "Selected";
      break;
    
    case '2':
      $nivel_2 = "Selected";
      break;

    case '3':
      $nivel_3 = "Selected";
      break;
  }

?>
<!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-lett">
        <h2 class="mt-5">Actualizar post</h2>
      </div>
    </div>
    <br><br>
    <div class="row">
      <div class="col-lg-12 text-left">
       
        <form role="form" action="/update" method="post">

          <input type="hidden" name="id" id="id" value="<?php echo $post_id; ?>">
          <div class="form-group row">
            <label for="autor" class="col-lg-2 col-form-label">Autor</label>
             
              <div class="col-lg-8 text-lett">
              <select class="form-control" name="author_id" id="author_id">
                 <?php
                  foreach ( $authors as $author) 
                  {
                    if ( $author_id == $author['id'])
                    {
                      $selected = "Selected";
                    }
                    else
                    {
                       $selected = "";
                    }
                    echo "<option value=".$author['id']." ". $selected.">".$author['display_name']."</option>";
                  }
                ?>
              </select>
            </div>
            
          </div>

          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Categoria</label>
            
              <div class="col-lg-8 text-lett">
              <select class="form-control" name="category_id" id="category_id">
                <option value=1 <?php echo $nivel_1; ?>>Nivel 1</option>
                <option value=2 <?php echo $nivel_2; ?>>Nivel 2</option>
                <option value=3 <?php echo $nivel_3; ?>>Nivel 3</option>
              </select>
           
            </div>
          </div>

          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Título</label>
             
              <div class="col-lg-8 text-lett">
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
            </div>
           
          </div>

          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Slug</label>
             
              <div class="col-lg-8 text-lett">
                <input type="text" class="form-control" id="slug" name="slug" value="<?php echo $slug; ?>">
            </div>
           
          </div>

          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Breve</label>
             
              <div class="col-lg-10 text-lett">
                 <textarea class="form-control" rows="3" id="brief" name="brief"><?php echo $brief; ?></textarea>
            </div>
             
          </div>

          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Texto</label>
             
              <div class="col-lg-10 text-lett">
                 <textarea class="form-control" rows="3" id="text" name="text"><?php echo $text; ?></textarea>
            </div>
             
          </div>
          
          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Creado</label>
             
              <div class="col-lg-3 text-lett">
                <input type="text" class="form-control" id="created" name="created" value="<?php echo $created; ?>">
            </div>
            
          </div>
          
          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Activado</label>
             
              <div class="col-lg-3 text-lett">
                <input type="checkbox"  id="enabled" name="enabled" <?php echo $enabled; ?>>
            </div>
            
          </div>


          <br><br>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <br><br>
      </div>
    </div>

  </div>


