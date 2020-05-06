<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">

      <?php

          foreach ( $posts as $post) 
          {
            echo '
            <div class="post-preview">
              <a href="/post/'.$post['id'].'">
                <h2 class="post-title">
                  '.$post['title'].'
                </h2>
                
              </a>
              <p class="post-meta">Posted by
                <a href="/author/'.$post['author_id'].'">'.$post['display_name'].'</a>
                '.date( "d/m/Y", strtotime( $post['created'])).'</p>
              <p class="post-meta">'.$post['brief'].'</p>
            </div>
            <hr>
            ';
          }

      ?>
      
    </div>
  </div>
</div>