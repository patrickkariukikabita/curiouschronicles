<?php
if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
  $basePath = './';
  $homepath="index.php";
} else {
  $basePath = '../';
  $homepath="../";
}
?>
  <!-- div with non-sticky logo  -->
  <div class="container-fluid bg-dark ">
      <div class='row'>
          
    <div class="col logodiv  text-light">
      <a class="navbar-brand basepathdiv" href="<?php echo $homepath ?>" 
      data-basepath="<?php echo $basePath ?>">
        <img src="<?php echo  $basePath ?>logos/transparent.png"
          class="navbar-brand "  style="height:70px;width:100px;"> 
      </a>
      </div>
      
         <div class="col-8 d-flex justify-content-end align-items-center" >
  <!-- Large devices -->
    <div class=" nav-link  d-none d-lg-block justify-content-center menumargin">
        <a class="text-light menuFont me-2 btn btn-dark" href="<?php echo $basePath?>author/authorLogin.php" role="button" >
          <i class="fa fa-pencil text-orange me-1"></i> Writer
        </a>
    </div>

    <!-- Small devices modal -->
    <div class=" nav-link mx-2 d-lg-none justify-content-center ">
        <a class="text-light menuFont me-2 btn btn-dark" href="<?php echo $basePath?>author/authorLogin.php" role="button" >
          <i class="fa fa-pencil text-orange me-1"></i> Writer
        </a>
    </div>
    
    <div class= "mx-2">
     <!--<a class=" menuFont text-light" href="<?php echo  $basePath ?>memer/index.php"> <i class="fa  me-1 text-info">🤣🤣 </i> Memes</a>-->
    </div>
    <div class= "mx-2">
     <a class=" menuFont text-light btn btn-dark" href="<?php echo  $basePath ?>terms/aboutUs.php" type="button"> <i class="fa fa-info me-1 text-info"> </i> About Us</a>
    </div>
 
      

    </div>
    </div>
    </div>
    <!--end of first div-->
    
    
  <!-- including the top menu -->
  <div class="container-fluid bg-dark sticky-top pb-2">
  <div class="d-flex flex-wrap justify-content-evenly justify-content-md-evenly justify-content-lg-center align-items-center py-1">    
    <div class="nav-link  menumargin">
      <a class="btn btn-dark text-light menuFont " href="<?php echo $homepath ?>" type="button">
        <i class="fa fa-home"></i> Home
      </a>
    </div>

    <div class="nav-link  menumargin">
 <button class="btn btn-dark text-light  menuFont categorybutton"
 type="button">
         <i class="fa fa-folder"></i> Categories
    </button>
    </div>
    
    
  
   
<!--handling search-->
    <!-- Large devices -->
    <div class="nav-link  d-none d-lg-block menumargin">
      <input class="searchinput form-control" placeholder="Search" type="text">
    </div>

    <!-- Small devices -->
    <div class="nav-link mx-2 d-lg-none justify-content-center">
      <a class="text-light menuFont searchbtn" href="#">
        <i class="fa fa-search searchinitiator"></i>
      </a>
    </div>

  </div>
</div>

<!-- modal on small devices -->
<div id="myModal" class="modal bg-dark">
  <div class="modal-dialog bg-dark">
    <div class="modal-content bg-secondary">
      <div class="modal-header">
        <h5 class="modal-title text-light">Search Here</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
          
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <input type="text" class="form-control searchinput modalsearchinput" placeholder="Search">
        </div>
      </div>
    </div>
  </div>
</div>





<!-- Full-screen Modal -->
<div class="modal fade" id="multiColumnModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content bg-dark">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-warning h4 fw-bold" id="exampleModalLabel">Categories</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Dropdown content -->
            <div class="container-fluid bg-dark">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
          <?php
          $categories = getCategories($conn);
          foreach ($categories as $category) {
              $categoryName = $category[0];
              $categoryRandid = $category[1];
              $categoryDescription = $category[2];
              $strippedText = strip_tags($categoryDescription);
              $maxLength = 100; // Maximum length before ellipsis
              if (strlen($strippedText) > $maxLength) {
                  $ellipsizedText = substr($strippedText, 0, $maxLength) . '...';
              } else {
                  $ellipsizedText = $strippedText; // Keep the original text if it's shorter
              }

              $categslug = $category[3];

              $output='<div class="col bg-dark">
           <a href="' . $basePath . 'category/' . $categslug . '" class="text-light  pe-2">
              <div class="card shadow text-light bg-dark border " style="max-height:200px;height:200px;">
            <div class="card-header fw-bold text-warning"> ' . $categoryName . '</div>
           <div class="card-body hoverchange">
              <p class="card-text ">' . $ellipsizedText . ' </p>
             </div>
              </div>
              </a>
              </div>'; // close col

             echo $output;

             
          }
         
          ?>
           </div>
        </div>
      </div>
      </div>
      </div>
      </div>
    

