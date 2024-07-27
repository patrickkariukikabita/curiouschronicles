<?php
session_start();
require_once './resources/config.php';
$conn= DatabaseConnection::getInstance();
 if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
        $pathprefix = './';
      } else {
        $pathprefix = '../';
      }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="HandheldFriendly" content="true">
  <meta name="description" content="<?php echo $sitename?> Home">
  <meta name="keywords" content="blog, articles, new, today, content">
  <link rel="icon" type="image/x-icon" href="./logos/favicon.ico" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>
    <?php echo "Home - " . $sitename; ?>
  </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="<?php echo $pathprefix?>menu/menu.js?v=2"></script>
  <script src="https://cdn.jsdelivr.net/npm/intersection-observer@0.12.2/intersection-observer.min.js"></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7410297700829623"
     crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?php echo $pathprefix?>menu/menu.css?v=4">
</head>
<body class="bg-light">
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
      <?php include $pathprefix."articles/featuredArticleHtml.php"?>

        <!-- Nested row for non-featured blog posts-->
        <div class="row">
          <div class="col-lg-6">
          <div class="d-flex justify-content-center fw-bold text-light my-2 py-2 h4 
          bg-maroon headingFont">Latest
          </div>
           <!-- where new Articles come  -->
             <div class="dataContainer m-0 p-0">
            <!--new articles come here-->
            </div>
          </div>
          

          <!-- where most popular articles come -->
          <div class="col-lg-6">
          <div class="d-flex justify-content-center fw-bold text-light my-2 py-2 h4
          bg-colorfish headingFont">Editor's Choice</div>
           <?php include $pathprefix."articles/homeSuggestedArticlesHtml.php"?>
          </div>
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
    <!--mailing list-->
<?php include $pathprefix."mailing/mailingListSidebar.php"?>
<?php include $pathprefix.'categories/trendingCategories.php'?>
<?php include $pathprefix.'author/trendingAuthors.php'?>
 
<!-- end of authors and categories -->
        <!-- Founder widget-->
       <?php include $pathprefix."founder/founder.php"?>
      </div>
    </div>
  </div>

<!-- footer -->
<?php include $pathprefix."menu/footer.php"?>
<!-- Add these scripts at the end of your HTML body section -->
  <script src="<?php echo $pathprefix?>menu/menu.js?<?php echo time()?>"></script>
   <script src="<?php echo $pathprefix?>resources/notify.min.js"></script>
  <script>
    $(document).ready(function () {

      // account propagating menuactions
      $(document).on("click", ".authorLoginbtn,.logoutbtn,.createAccountbtn", function () {
        var action = $(this).data("action")
        if (action == "signup") {
          window.location.href = "./author/authorSignup.php"
        } else if (action == 'login') {
          window.location.href = "./author/authorLogin.php"
        } else if (action == "logout") {
          window.location.href = "./author/logout.php"
        }
      })

// handling pagination

// handling pagination
function fetchData(pageNumber) {
    $.ajax({
        url: '../pagination/homeNewArticlesController.php',
        type: 'GET',
        data: {page:pageNumber},
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
        fetchData(currentPage - 1);
    } else if ($(this).hasClass("nextPage")) {
        fetchData(currentPage + 1);
    } else {
        fetchData(parseInt(clickedPage));
    }
});

// Initial fetch
fetchData(1);





    });
  </script>
</body>

</html>