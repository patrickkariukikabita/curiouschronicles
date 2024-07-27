<?php
if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
        $basePath = './articles_cover/';
        $pathprefix="./";
    } else {
        $basePath = '../articles_cover/';
        $pathprefix="../";
    }
?>

<!-- Popular Categories widget -->
<div class="card mb-4">
  <div class="card-header headingFont text-light fw-bold bg-maroon"><i class="fa fa-folder"> </i> 
  Trending Categories</div>
  <div class="card-body">
    <div class="row">
        <ul class="list-unstyled mb-0">
          <?php
          $categories = getMostViewedCategories($conn, 6);
          foreach ($categories as $category) {
            $categoryName = $category[0];
            $categoryViews = $category[1];
            $categoryRandid = $category[2];
            $categoryDescription=$category[3];
             $category_slug=$category[4];
            echo '<li class="mb-2 mx-1 px-2 bodyFont btn btn-raised btn-outline-secondary rounded-pill " title="'.$categoryDescription.'">
            <a href="'.$pathprefix.'category/' . $category_slug . '" class="text-dark" >
            ' . $categoryName . '</a>
            </li>';
          }
          ?>
        </ul>
      <!-- Add more columns if needed -->
    </div>
  </div>
</div>