<?php
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
if(isset($_GET['art'])&& $_SERVER['REQUEST_METHOD']=="GET"){
  $url=clean($_GET['art']);
// Extract the ID and title
$parts = explode('-', trim($url, '/'));
$article_id = intval($parts[0]);
}else{
  // missing article
  header('location:../errors/error.php'); 
  exit;
}

  
    // Fetch the newest 10 articles with author names and category descriptions
    $stmt = $conn->prepare("
    SELECT a.*, au.full_name AS author_name,au.slug as authorslug,au.author_randid as authorrand, c.category_name,c.slug as catslug,
     c.description AS category_description
    FROM articles AS a
    INNER JOIN article_author AS aa ON a.article_randid = aa.article_randid
    INNER JOIN authors AS au ON aa.author_randid = au.author_randid
    INNER JOIN categories AS c ON a.category_randid = c.category_randid
     where a.article_id=? and a.slug=? and a.publishstatus=?
");
$stmt->execute([$article_id,$url,"true"]);
if($stmt->rowCount()>0){
$article = $stmt->fetch(PDO::FETCH_ASSOC);
// Generate HTML for articles

    $articleId = $article['article_id'];
    $category_randid=$article['category_randid'];
    $title = $article['title'];
    $authorslug = $article['authorslug'];
    $catslug = $article['catslug'];
    $content = $article['content'];
    $date = $article['date'];
    $authorName = $article['author_name'];
    $articleCategoryName = $article['category_name'];
    $categoryDescription = $article['category_description'];
    $article_randid = $article['article_randid'];
    $cover=$article['article_cover'];
    $authorrand=$article['authorrand']; 
    $articleUrl=generateArticleUrl($conn, $article_randid);
    $articleogcoverurl='https://www.sociolme.com/'.str_replace("../", "", $cover);;
    $basePath = '';
    if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
        $basePath = './articles_cover/';
        $pathprefix="./";
    } else {
        $basePath = '../articles_cover/';
        $pathprefix="../";
    }
    $placeholder=$basePath."placeholder.webp";
    $url = generateArticleUrl($conn, $article_randid);
}else{
    // // missing query parameter
    header('location:../errors/error.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="author" content="<?php echo $authorName;?>">
    <meta name="keywords" content="<?php echo $title;?>">
      <meta name="description" content="<?php echo $title;?>">
      <!--facebook meta tags-->
      <meta property="og:title" content="<?php echo $title; ?>">
  <meta property="og:description" content="<?php echo $title;?>">
  <meta property="og:url" content="<?php echo $articleUrl; ?>">
  <meta property="og:image" content="<?php echo $articleogcoverurl; ?>">
<meta name="HandheldFriendly" content="true">
<link rel="icon" type="image/x-icon" href="../logos/favicon.ico" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title><?php echo $title ." - ".$sitename;?></title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7410297700829623"
     crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/intersection-observer@0.12.2/intersection-observer.min.js"></script>
  <link rel="stylesheet" href="../menu/menu.css?v=9">

</head>
<body class='bg-light'>
<!-- including top menu file  -->
<?php include "../menu/menu.php";?>

  <!-- the header containing the ads -->
  <header class="py-5 bg-light border-bottom mb-4 bodyFont">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="text-center text-lg-start my-5">
            <h1 class="fw-bolder"> <?php echo $sitename?></h1>
            <p class="lead mb-0">The Home To  New, Trending And Interesting Articles</p>
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
  <div class="container bg-light">
    <div class="row ">
      <!-- creating the middle piece the article comes here-->
      <div class="col-lg-8 bg-light">
      <!-- the content comes here -->
      <!-- share article -->
      <div class="d-flex  justify-content-between align-items-center bg-maroon" style="height:50px;">
  
      <div class="nav-link justify-content-center menumargin">
  <div class="dropdown menumargin">
    <a class="text-light dropdown-toggle headingFont  p-1" href="#" role="button" id="socialDropdown" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa fa-share  fa-lg"></i> Share 
    </a>
    <ul class="dropdown-menu dropdown-menu-end socialDropdown bg-dark" aria-labelledby="socialDropdown">
    <li>
        <a class="dropdown-item social-link text-light hoverchange copy-link-btn" href="#" data-link="<?php echo $url?>">
          <i class="fa fa-copy fa-lg mx-3 text-light "></i> Copy Link
        </a>
      </li>
    
     <li>
        <a class="dropdown-item social-link  text-light hoverchange" 
        href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url?>" target="_blank">
          <i class="fa fa-facebook fa-lg mx-3"></i> Facebook
        </a>
      </li>
      <li>
        <a class="dropdown-item social-link  text-light hoverchange" 
        href="https://twitter.com/intent/tweet?url=<?php echo $url?>" target="_blank">
          <i class="fa fa-twitter fa-lg mx-3"></i> Twitter
        </a>
      </li>
      <li>
        <a class="dropdown-item social-link text-light hoverchange" 
        href="https://www.linkedin.com/shareArticle?url=<?php echo $url?>" target="_blank">
          <i class="fa fa-linkedin fa-lg mx-3"></i> LinkedIn
        </a>
      </li>
      <li>
        <a class="dropdown-item social-link text-light hoverchange" 
        href="https://github.com/login?return_to=%2Fnew&source_repo=<?php echo $url?>" target="_blank">
          <i class="fa fa-github fa-lg mx-3"></i> GitHub
        </a>
      </li>
      <li>
        <a class="dropdown-item social-link text-light hoverchange" 
        href="https://web.whatsapp.com/send?text=<?php echo $url?>" target="_blank">
          <i class="fa fa-whatsapp fa-lg mx-3"></i> WhatsApp
        </a>
      </li>
    </ul>
  </div>
</div>
<span class="mx-3 tiny text-light"><i class="fa fa-calendar"> </i> <?php echo date('jS F Y', strtotime($date))?></span>
</div>

<!-- title informstion -->
            <div class="my-3 d-flex justify-content-between align-content-center ">
                <a href="../category/<?php echo $catslug?>" 
                 class=" btn btn-secondary text-white btn-outline-secondary" >
                  <span class="mx-3  "><i class="fa fa-folder ">  </i> <?php echo $articleCategoryName?></span>
                </a>
                <a href="../author/<?php echo $authorslug?>" 
                class="text-orange btn btn-light text-orange btn-outline-secondary" >
                  <span class="mx-3  "><i class="fa fa-user ">   </i> <?php echo $authorName?></span>
                </a>
            </div>

          <div class="fw-bold  text-dark h2 " style="word-wrap: break-word; ">
            <?php echo $title; ?>
          </div>
          <div class="mb-3">
            <img class="lazy" data-src=" <?php echo $cover; ?>" src="<?php echo $placeholder; ?>"
             style="width: 100%;height:100%;" class="img-fluid article_image">
          </div>

       <!-- where the article goes -->
       <div class=' mx-2 border-left articleFont articlediv'>
          <?php // Generate random content
            $randomContent =  randomArticle($conn,$articleId);
            $paragraphIndex=4;
            $modifiedContent=insertRecommendedArticle($content,$randomContent,$paragraphIndex);
          echo $modifiedContent;
              ?>
        </div>
        <!-- no pagination needed here for this page -->
      </div>




      <!-- Side widgets-->
      <div class="col-lg-4 d-none d-lg-block">
<!-- Popular Categories widget -->
 <?php include $pathprefix.'/categories/trendingCategories.php'?>
<?php include $pathprefix.'/author/trendingAuthors.php'?>
<?php include $pathprefix."mailing/mailingListSidebar.php"?>

          <!-- editor's choice -->
        <div class="col-12 ">
          <div class="d-flex justify-content-center fw-bold text-light my-2 py-2 h4
          bg-colorfish headingFont">Editor's Choice</div>
           <?php include "../articles/homeSuggestedArticlesHtml.php"?>
          </div>

      </div>
    </div>
  </div>

  
  <?php 
  // update article as viewed
  updateArticleViews($conn, $article_randid) ;
  // update category views
   updateCategoryViews($conn, $category_randid);
  // update author views
   updateAuthorViews($conn, $authorrand);
  ?>
  <?php include"../menu/footer.php"?>
  <script src="<?php echo $pathprefix?>menu/menu.js?<?php echo time()?>"></script>
  <script src="../resources/notify.min.js"></script>
  <script>
    $(document).ready(function() {
      menuPropagation()
   


    $('.copy-link-btn').click(function(e) {
      e.preventDefault()
      var link = $(this).data('link');
      var tempInput = $('<input>');
      $('body').append(tempInput);
      tempInput.val(link).select();
      document.execCommand('copy');
      tempInput.remove();
      

       // Show toast notification
  $.notify('Link copied to clipboard: ' , {
    position: 'top left',
    autoHideDelay: 2000, // Adjust the duration as needed
    className: 'success' // Add a CSS class for styling the toast notification
  });
    });




    });
  </script>

</body>
</html>
