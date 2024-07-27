<?php
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
if (isset($_GET['author']) && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['author_randid'] == clean($_GET['author'])) {
  $authorrandid = clean($_SESSION['author_randid']);
  $query="select full_name,email,active_status from authors where author_randid=?";
  $stmt=$conn->prepare($query);
  $stmt->execute([$authorrandid]);
  $result=$stmt->fetch(PDO::FETCH_ASSOC);
  $authorname= $result['full_name'];
    $email= $result['email'];
      $active_status= $result['active_status'];
    //   check if email is verified
     // check if the email is verified
    if(!isVerifiedEmail($conn,clean($_SESSION['author_randid']))){
         header("location:verifyEmail.php?author=" . $_SESSION['author_randid']);    exit;
    }
} else {
  // missing query parameter
  header('location:authorLogin.php');
  exit;
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
  <title>
    <?php echo "Author Home - " . $sitename; ?>
  </title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/intersection-observer@0.12.2/intersection-observer.min.js"></script>
  <link rel="stylesheet" href="../menu/menu.css?v=33">

  
</head>

<body class='bg-light' data-authorrandid="<?php echo $authorrandid ?>" 
data-active="<?php echo $active_status ?>" data-email="<?php echo $email ?>">
  <!-- including top menu file  -->
  <?php include "../menu/menu.php"; ?>
  <div class="container">
    <div class="p-3 mt-1 text-light d-flex justify-content-between align-items-center"
      style="background-color:#d24d33;">
      <h3 class="text-center flex-grow-1"><?php echo " - [".$authorname."]"?></h3>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

      <!-- Handling creating a new article -->
      <div class="col my-2 ">
        <div class="card shadow mb-4 newarticlediv d-flex custom-gray justify-content-center align-content-center hoverchange"
          style="max-height: 400px; min-height: 400px;" title="Write An Article.">
          <div class="text-center h2 text-orange bg-transparent "><i class="fa fa-plus-circle fw-bold"> New Article</i>
          </div>
        </div>
      </div>

      <?php
      // Your PHP logic here to fetch and loop through items
      $stmt = $conn->prepare("
      SELECT a.*, au.full_name
       AS author_name,au.author_randid as authorrand, c.category_id,c.category_name, c.category_randid,c.slug as catslug,
       c.description AS category_description
      FROM articles AS a
      INNER JOIN article_author AS aa ON a.article_randid = aa.article_randid
      INNER JOIN authors AS au ON aa.author_randid = au.author_randid
      INNER JOIN categories AS c ON a.category_randid = c.category_randid where au.author_randid=?
      ORDER BY a.date DESC;
  ");
      $stmt->execute([$authorrandid]);
      if ($stmt->rowCount() > 0) {
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Output the generated HTML
      
        foreach ($articles as $article) {
         
          $articleId = $article['article_id'];
          $title = $article['title'];
         $articleslug = $article['slug'];
        $catslug = $article['catslug'];
          $content = $article['content'];
          $date = $article['date'];
          $authorName = $article['author_name'];
          $categoryName = $article['category_name'];
          $category_randid = $article['category_randid'];
          $category_id = $article['category_id'];
          $categoryDescription = $article['category_description'];
          $article_randid = $article['article_randid'];
          $cover = $article['article_cover'];
          $authorrand = $article['authorrand'];
          $publishstatus = $article['publishstatus'];
          $strippedText = strip_tags($content); // Remove HTML tags
          $ellipsizedText = substr($strippedText, 0, 150); // Ellipsize text if needed
          $authorArticleData = $ellipsizedText . ' ...';
          $articleviews = getArticleViews($conn, $article_randid);
          if ($publishstatus =="true") {
            $publishedstatus = "fa-check text-success";
          }else{
            $publishedstatus = "fa-times text-orange";
          }
          
          $basePath = '';
          if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
              $basePath = './articles_cover/';
              $pathprefix="./";
          } else {
              $basePath = '../articles_cover/';
              $pathprefix="../";
          }
          $placeholder=$basePath."placeholder.webp";
      
          $html = '<div class="border-0 border-bottom div1 border-secondary p-2 my-1 col" style=""
          onmouseover="this.querySelector(\'.article-image\').style.filter=\'grayscale(10%)\'; 
          this.querySelector(\'.title\').style.color=\'#1845cd\'"
          onmouseout="this.querySelector(\'.article-image\').style.filter=\'\'; this.querySelector(\'.title\').style.color=\'\'">
          <a href="'.$pathprefix.'article/'.$articleslug.'" class="text-dark headingFont titlea"
            style="text-decoration: none;">
              <img data-src="'.$cover.'" src="'.$placeholder.'" style="width: 100%; max-height: 150px;" class="lazy img-fluid article-image">
          </a>
          <div class="d-flex justify-content-between align-items-center my-1">
            <p class="h6" style="color:#d24d33;" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$categoryDescription.'">
              <a href="'.$pathprefix.'category/'.$catslug.'" style="color: #d24d33;text-decoration:none;">'.$categoryName.'</a>
            </p>
            <p class="ml-5" style="font-size:10px;">'.date("jS F Y", strtotime($date)).'
            </p>
          </div>
          <div class="fw-bold title p-1" style="word-wrap: break-word;">'.$title.'
          </div>
          <div class="container my-2 changesdiv" style="position: absolute; bottom: 0; left: 0; width: 100%;">
            <div class="row mx-2">
              <div class="col-12 d-flex justify-content-between align-items-center p-1 my-3 ">
                <span class="ms-1  "><i class="text-orange fa fa-eye">
                    '.getArticleViews($conn, $article_randid).' </i>
                </span>
                <i class="  fa '.$publishedstatus.' fw-bold ">
                    </i>
                  <button class="btn btn-outline-none btn-secondary editarticlebtn text-light" data-article_randid='.$article_randid.'>
                    <i class="text-light fa fa-pencil fw-bold text-light">
                      Edit
                    </i>
                  </button>
              </div>
           
            </div>
          </div>
        </div>';
              ?>
          <div class="col my-2">
            <!-- Display individual item content here -->
            <div class="card mb-4" style="max-height:400px;min-height:400px;">
              <?php echo $html ?>
            </div>
          </div>
          <?php
        }
      }
      ?>
      <!-- A status modal -->
      <div class="modal fade" id="publishmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center">
        <div  class="modalstatusdiv d-flex" style="word-wrap;break-word;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



    </div>
  </div>
  <!-- the footer -->
  <?php include "../menu/footer.php" ?>
<script src="<?php echo $pathprefix?>menu/menu.js?<?php echo time()?>"></script>
    <script src="../resources/notify.min.js"></script>
  <script>
    menuPropagation()
  </script>
  <script>
    $(document).ready(function () {
      // handling creation of new article
   $(".newarticlediv").click(function() {
  var author = $("body").data("authorrandid");
window.location.href = "../articles/newArticle.php?author=" + author;
});

  // handling article modification
   $(".editarticlebtn").click(function() {
       var article_randid=$(this).data('article_randid');
window.location.href = "../articles/modifyArticle.php?art=" + article_randid;
});


    });
  </script>

</body>

</html>