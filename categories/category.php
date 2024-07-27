<?php
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
    $basePath = '';
    if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
        $basePath = './articles_cover/';
        $pathprefix="./";
    } else {
        $basePath = '../articles_cover/';
        $pathprefix="../";
    }
if(isset($_GET['cat'])){
$url=clean($_GET['cat']);
  // update category views
$query="select * from categories where slug=?";
$catstmt=$conn->prepare($query);
$catstmt->execute([$url]);
$catOut=$catstmt->fetch(PDO::FETCH_ASSOC);
$catcategoryName=$catOut['category_name'];
$category_randid=$catOut['category_randid'];
updateCategoryViews($conn, $category_randid);

}else{
    // missing query parameter
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
<meta name="HandheldFriendly" content="true">
<link rel="icon" type="image/x-icon" href="../logos/favicon.ico" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title><?php echo $catcategoryName ." - ".$sitename;?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../menu/menu.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/intersection-observer@0.12.2/intersection-observer.min.js"></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7410297700829623"
     crossorigin="anonymous"></script>
</head>
<body class='bg-light' data-slug="<?php echo $url?>">
<!-- including top menu file  -->
<?php include $pathprefix."menu/menu.php";?>
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
      <!-- creating the middle piece -->
      <div class="col-lg-8 ">

      <div class="d-flex justify-content-center fw-bold text-light mb-1 py-2 h4 
          bg-maroon headingFont"> Featured Article </div>
        <!-- one large featured article -->
      <?php include "../articles/featuredArticleHtml.php"?>

        <!-- Category Articles come hhere-->
        <div class="d-flex justify-content-center fw-bold text-light my-2 py-2 h4 
          bg-secondary headingFont"><i class="fa fa-folder fw-bold "> <?php echo"  ".$catcategoryName?> </i> </div>
        <div class="dataContainer rowcols row row-cols-1 row-cols-md-2 row-cols-lg-2 p-2 ">
          <!--data loaded here-->
        </div>

        <!-- Pagination-->
          <div class="dataStatus d-none d-flex justify-content-center align-items-center">
            <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
                </div> <span class="mx-2 lead text-primary">Fetching Articles...</span>
        </div>
     <nav aria-label="Pagination">
    <hr class="my-0" />
    <ul class="pagination justify-content-center my-4 paginationControls">
        <li class="page-item disabled prevPage"><a class="page-link " href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
        <!-- Page numbers will be dynamically inserted here -->
        <li class="page-item nextPage"><a class="page-link " href="#">Older</a></li>
    </ul>
    </nav>
      </div>





      <!-- Side widgets-->
      <div class="col-lg-4 d-none d-lg-block">
       

<?php include $pathprefix.'/categories/trendingCategories.php'?>
<?php include $pathprefix.'/author/trendingAuthors.php'?>
<!--mailing list-->
<?php include "../mailing/mailingListSidebar.php"?>
       
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
  <script src="../menu/menu.js?v=<?php echo time()?>"></script>
  <script>
     menuPropagation()
  </script>
  <script>
    $(document).ready(function() {
      // Show current page
      var currentPage = window.location.href;
      $('.navbar-nav .nav-link').each(function() {
        if ($(this).attr('href') === currentPage) {
          $(this).addClass('active');
        }
      });

window.slug=$("body").data("slug")

   // Navigate to PHP page on menu item click
$('.navbar-nav .nav-link').click(function(e) {
  e.preventDefault();
  var menuItem = $(this).text().toLowerCase();
  var phpPage = './' + menuItem + '/' + menuItem + '.php';
  if (phpPage === './home/home.php') {
    phpPage = '../';
    return;
  }
  if (menuItem === 'blog') {
    window.location.reload()
    return;
  }
  window.location.href = phpPage;
});


// handling pagination
function fetchData(pageNumber,slug) {
    $.ajax({
        url: '../pagination/categoryPaginationController.php',
        type: 'GET',
        data: {page:pageNumber,slug:slug},
        beforeSend:function(){
            $(".dataStatus").removeClass("d-none")
        },
        success: function(response) {
            var jsonObject = JSON.parse(response);
            // Accessing properties
            var htmlData = jsonObject.data;
            var total = jsonObject.total;
            var itemsPerPage = jsonObject.itemsPerPage;
            // Render your data here...
             $(".dataContainer").html(htmlData)
             $(".dataStatus").addClass("d-none")
            // Update pagination controls
            updatePaginationControls(pageNumber,total,itemsPerPage);
            observeLazyImages();
        }
    });
}

function updatePaginationControls(currentPage, totalItems, itemsPerPage) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const paginationControls = $(".paginationControls");
    const maxPagesToShow = 5; // Adjust this as needed
    const pagesToShowAroundCurrent = Math.floor(maxPagesToShow / 2);

    // Clear existing page numbers
    paginationControls.find("li.page-item:not(.prevPage, .nextPage)").remove();

    // Insert new page numbers
    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= currentPage - pagesToShowAroundCurrent && i <= currentPage + pagesToShowAroundCurrent)) {
            const pageItem = $("<li>").addClass("page-item");
            if (i === currentPage) {
                pageItem.addClass("active");
            }
            const pageLink = $("<a>").addClass("page-link").attr("href", "#!").text(i);
            pageItem.append(pageLink);
            paginationControls.find(".nextPage").before(pageItem);
        } else if (i === currentPage - pagesToShowAroundCurrent - 1 || i === currentPage + pagesToShowAroundCurrent + 1) {
            // Add ellipsis
            const ellipsisItem = $("<li>").addClass("page-item disabled");
            const ellipsisLink = $("<a>").addClass("page-link").attr("href", "#!").text("...");
            ellipsisItem.append(ellipsisLink);
            paginationControls.find(".nextPage").before(ellipsisItem);
        }
    }

    // Enable/Disable newer and older buttons
    if (currentPage <= 1) {
        paginationControls.find(".prevPage").addClass("disabled");
    } else {
        paginationControls.find(".prevPage").removeClass("disabled");
    }

    if (currentPage >= totalPages) {
        paginationControls.find(".nextPage").addClass("disabled");
    } else {
        paginationControls.find(".nextPage").removeClass("disabled");
    }
}


// Pagination controls click events
$(document).on("click", ".paginationControls .page-link", function(e) {
    e.preventDefault();
    const clickedPage = $(this).text();
    if ($(this).hasClass("prevPage")) {
        fetchData(currentPage - 1,slug);
    } else if ($(this).hasClass("nextPage")) {
        fetchData(currentPage + 1,slug);
    } else {
        fetchData(parseInt(clickedPage),slug);
    }
});

// Initial fetch
fetchData(1,slug);


  


    });
  </script>

</body>
</html>
