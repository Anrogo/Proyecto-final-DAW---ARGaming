
<!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-lett">
        <h2 class="mt-5">Nuevo de post</h2>
      </div>
    </div>
    <br><br>
    <div class="row">
      <div class="col-lg-12 text-left">
       
        <form role="form" action="/add" method="post">


          <div class="form-group row">
            <label for="autor" class="col-lg-2 col-form-label">Autor</label>
             
              <div class="col-lg-8 text-lett">
              <select class="form-control" name="author_id" id="author_id">
                <?php
                  foreach ( $authors as $author) 
                  {
                    echo "<option value=".$author['id'].">".$author['display_name']."</option>";
                  }
                ?>
                
              </select>
            </div>
            
          </div>

          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Categoria</label>
            
              <div class="col-lg-8 text-lett">
              <select class="form-control" name="category_id" id="category_id">
                <option value=1>Nivel 1</option>
                <option value=2>Nivel 2</option>
                <option value=3>Nivel 3</option>
              </select>
           
            </div>
          </div>

          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Título</label>
             
              <div class="col-lg-8 text-lett">
                <input type="text" class="form-control" id="title" name="title" placeholder="">
            </div>
           
          </div>

          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Slug</label>
             
              <div class="col-lg-8 text-lett">
                <input type="text" class="form-control" id="slug" name="slug" placeholder="">
            </div>
           
          </div>

          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Breve</label>
             
              <div class="col-lg-10 text-lett">
                 <textarea class="form-control" rows="3" id="brief" name="brief"></textarea>
            </div>
             
          </div>

          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Texto</label>
             
              <div class="col-lg-10 text-lett">
                 <textarea class="form-control" rows="3" id="text" name="text"></textarea>
            </div>
             
          </div>
          
          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Creado</label>
             
              <div class="col-lg-3 text-lett">
                <input type="text" class="form-control" id="created" name="created" placeholder="">
            </div>
            
          </div>
          
          <div class="form-group row">
            <label for="categoria" class="col-lg-2 col-form-label">Activado</label>
             
              <div class="col-lg-3 text-lett">
                <input type="checkbox"  id="enabled" name="enabled">
            </div>
            
          </div>



          <br><br>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <br><br>
      </div>
    </div>

  </div>



