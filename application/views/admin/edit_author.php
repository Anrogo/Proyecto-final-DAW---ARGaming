<?php


  # recogemos los valores que nos envia el controlador
  ( isset( $autor[0]['id']) ? $autor_id =  $autor[0]['id'] : $autor_id = '');
  ( isset( $autor[0]['display_name']) ? $display_name =  $autor[0]['display_name'] : $display_name = '');
  ( isset( $autor[0]['email']) ? $email =  $autor[0]['email'] : $email = '');
  

  if (  isset( $autor[0]['enabled']) &&  $autor[0]['enabled'] == "1")
  {
    $enabled =  "Checked";
  }
  else
  {
    $enabled =  "";
  }


?>
<!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-lett">
        <h2 class="mt-5">Editando autor: <?php echo $display_name; ?></h2>
      </div>
    </div>
    <br><br>
    <div class="row">
      <div class="col-lg-12 text-left">
       
        <form role="form" action="/update_autor" method="post">

          <input type="hidden" name="id" id="id" value="<?php echo $autor_id; ?>">
          <div class="form-group row">
            <label for="display_name" class="col-lg-2 col-form-label">Nombre</label>
             
              <div class="col-lg-5 text-lett">
                <input type="text" class="form-control" id="display_name" name="display_name"  value="<?php echo $display_name; ?>" >
            </div>
           
          </div>

          <div class="form-group row">
            <label for="email" class="col-lg-2 col-form-label">Email</label>
             
              <div class="col-lg-8 text-lett">
                  <input type="text" class="form-control" id="email" name="email"  value="<?php echo $email; ?>">
            </div>
             
          </div>

          
   
          
          <div class="form-group row">
            <label for="enabled" class="col-lg-2 col-form-label">Activado</label>
             
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



