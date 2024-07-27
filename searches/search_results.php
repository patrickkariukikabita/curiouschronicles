<?php
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
$predicate="";

if(isset($_GET['predicate'])&& $_SERVER['REQUEST_METHOD']=="GET"){
  $predicate=clean($_GET['predicate']);

}else{
  // missing article
  $predicate="";
}
  if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
  $pathprefix = './';
  $homepath="index.php";
} else {
  $pathprefix = '../';
  $homepath="../";
}
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="icon" type="image/x-icon" href="../logos/favicon.ico" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title><?php echo  "Search  - ".$sitename;?></title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/intersection-observer@0.12.2/intersection-observer.min.js"></script>
  <link rel="stylesheet" href="../menu/menu.css?v=9">

</head>
<body class='bg-light'>
  <?php include $pathprefix."menu/menu.php";?>
 <!-- the header containing the ads -->
  <header class="py-2 bg-light border-bottom mb-4 bodyFont">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="text-center text-lg-start my-5">
            <div class="fw-bolder headingFont d-flex"> Search Here</div>
            <form action="" method="GET">
            <input class="form-control searcher border border-secondary border-2" name="predicate" value="<?php echo $predicate ?>" type="text">
            <button type="submit" class="btn btn-primary d-none">Search</button>
          </form>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <!-- Content for the hidden column in small devices -->
          <div class="text-center text-lg-start my-5">
            <h1 class="fw-bolder"> <?php echo $sitename?> </h1>
            <p class="lead mb-0">The Home To  New, Trending And Interesting Articles</p>
          </div>
        </div>

      </div>
    </div>
  </header>

<!-- the page contennt goes here -->
  <div class="container custom-gray">
    <div class="row ">
      <!-- creating the middle piece the article comes here-->
      <div class="col-lg-8 bg-light">
      <!-- the content comes here -->
      <!-- share article -->
      <div class="d-flex headingFont fw-bold  justify-content-center align-items-center bg-light text-dark" style="height:50px;">
      <i class="fa fa-search me-2"> </i> SEARCH RESULTS.
      </div>
      <div class="row "> 

      <div class="col-lg-2 py-2"> 
      </div>

      <div class="col-lg-9 py-2">
        
      <!-- fetch authors -->
      <div class="card mb-4">
          <div class="card-header headingFont fw-bold text-light bg-secondary"> 
            <i class="fa fa-user"> </i>  Authors
          </div>
        <div class="card-body">
          <div class="row">
        <ul class="list-unstyled mb-0">
        <?php 
        $authorsSearchedData= fetchSearchedAuthors($conn,$predicate,$searchLimit);
        foreach($authorsSearchedData as $data){
            $full_name=$data[1];
            $author_randid=$data[0];
             $author_slug=$data[2];
            echo '<li class="mb-2 mx-1 px-2 bodyFont btn btn-raised btn-outline-secondary rounded-pill " title="'.$full_name.'">
            <a href="../author/' . $author_slug . '" class="text-dark" >
            ' . $full_name . '</a>
            </li>';
        }
        ?>
        </ul>
        </div>
        </div>
        </div>


        <!-- fetch articles -->
        <div class="d-flex headingFont fw-bold  p-2 justify-content-start align-items-center bg-colorfish
         text-light"><i class="fa fa-book me-2"> </i> Articles
        </div>
        <?php
         $articlesSearchedData= fetchSearchedArticles($conn,$predicate,$searchLimit);
         foreach( $articlesSearchedData  as $articleData){
          $randid = $articleData[0];
          $title = $articleData[1];
          $cover = $articleData[2];
          $categoryName = $articleData[3];
          $categoryDescription = $articleData[4];
          $date = $articleData[5];
          $date = date('jS F Y', strtotime($date));
          $authorrand = $articleData[6];
          $authorName = $articleData[7];
          $category_randid = $articleData[8];
          // $relativecoverpath = preg_replace('/\./', '', $cover, 1);
           // Determine the relative path to the image based on the current file location
          $pathprefix = '';
          if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
              $pathprefix = './articles_cover/';
              $pathprefix="./";
          } else {
              $pathprefix = '../articles_cover/';
              $pathprefix="../";
          }
          // Extract the image name from the cover path
          $imageName = basename($cover);
          $placeholder=$pathprefix."placeholder.webp";
  
          // Construct the relative path to the image using the image name and the determined base path
          $relativecoverpath = $pathprefix . $imageName;
  
          $ellipsizedContent=$articleData[9];
          $article_slug=$articleData[10];
            $artauthor_slug=$articleData[11];
              $cat_slug=$articleData[12];
  
          $html = '
          <div class="card mb-2" onmouseover="this.querySelector(\'.title\').style.color=\'#1845cd\';
          this.querySelector(\'.article_image\').style.filter=\'grayscale(10%)\';"
          onmouseout=" this.querySelector(\'.article_image\').style.filter=\'\'; this.querySelector(\'.title\').style.color=\'\';">
                  <a href="'.$pathprefix.'article/'.$article_slug.'" style="width: 100%; ">
                  <img class="card-img-top lazy article_image mt-3" style="width:90%;height=302px; margin-left:5%;" 
                  data-src="' . $cover . '" src="' . $placeholder . '"alt=" Cover Image"  />
                  </a>
                  <div class="card-body">
                      <div class=" text-muted small my-2">
                      <a href="'.$pathprefix.'category/'.$cat_slug.'" class="text-primary px-2 me-1 border rounded-pill  border-secondary"
                      style="text-decoration:none; font-size:12px;" title="'.$categoryDescription .'">
                      <i  class="fa fa-folder"> </i>    ' . $categoryName . '
                       </a>
                      <a href="'.$pathprefix.'author/'.$artauthor_slug.'" class="px-2 border rounded-pill  border-secondary"
                      style="color: #d24d33;text-decoration:none; font-size:12px;" title="Posts By '.$authorName .'">
                      <i  class="fa fa-user"> </i> ' . $authorName . '
                       </a>              
                      </div>
                      <a href="'.$pathprefix.'article/'.$article_slug.'" class=" h5 headingFont title fw-bold">
                     '. $title . '
                          </a>
                      <p class="card-text bodyFont mt-2">'. $ellipsizedContent.'</p>
                  </div>
                  
              </div>
                  ';
          echo $html;
          }
        ?>
        </div>



     </div>
      </div>




      <!-- Side widgets-->
      <div class="col-lg-4 d-none d-lg-block">  
<?php include $pathprefix."mailing/mailingListSidebar.php"?>
<?php include $pathprefix.'categories/trendingCategories.php'?>
<?php include $pathprefix.'author/trendingAuthors.php'?>
 
          
<!-- end of authors and categories -->
   
          <!-- editor's choice -->
        <div class="col-12 ">
          <div class="d-flex justify-content-center fw-bold text-light my-2 py-2 h4
          bg-colorfish headingFont">Editor's Choice</div>
           <?php include "../articles/homeSuggestedArticlesHtml.php"?>
          </div>

      </div>
    </div>
  </div>

  

  <?php include "../menu/footer.php"?>
  <script src="../resources/notify.min.js"></script>
  <script src="../menu/menu.js?v=<?php echo time?>"></script>
  <script>
    $(document).ready(function() {
  menuPropagation()
    });
  </script>

</body>
</html>
