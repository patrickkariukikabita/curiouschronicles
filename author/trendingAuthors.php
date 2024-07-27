<?php
if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
        $basePath = './articles_cover/';
        $pathprefix="./";
    } else {
        $basePath = '../articles_cover/';
        $pathprefix="../";
    }
?>
   <!-- Popular Authors widget-->
         <div class="card mb-4">
          <div class="card-header headingFont fw-bold text-light bg-colorfish"> 
            <i class="fa fa-user"> </i> Trending Authors
          </div>
          <div class="card-body">
          <div class="row">
        <ul class="list-unstyled mb-0">
          <?php
          $categories = getMostViewedAuthors($conn, 6);
          foreach ($categories as $category) {
            $authorName = $category[0];
            $authorViews = $category[1];
            $authorRandid = $category[2];
             $authorslug = $category[3];
            echo '<li class="mb-2 mx-1 px-2 bodyFont btn btn-raised btn-outline-secondary rounded-pill " title="'.$categoryDescription.'">
            <a href="'.$pathprefix.'author/'.$authorslug . '" class="text-dark" >
            ' . $authorName . '</a>
            </li>';
          }
          ?>
        </ul>
 
           </div>
            </div>
          </div>