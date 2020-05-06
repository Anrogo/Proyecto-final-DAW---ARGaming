<?php
  
  $post = $post[0];
  
?>
<header class="masthead" style="background-image: url('img/post-bg.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-heading">
          <h1><?php echo $post['title']; ?></h1>
          <h2 class="subheading"><?php echo $post['brief']; ?></h2>
          <span class="meta">Posted by
            <a href="/autor/<?php echo $post['author_id']; ?>"><?php echo ($post['display_name']=='') ? 'Anónimo' : $post['display_name']; ?></a>
            <?php echo $post['created']; ?></span>
        </div>
      </div>
    </div>
  </div>
</header>
<br><br>
<article>
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <?php 
        echo str_replace( "\n", "<br>", $post['text']); 
        //echo $post['text'];

      ?>
    </div>
  </div>
</div>
</article>