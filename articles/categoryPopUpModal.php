<?php
if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
  $basePath = './';
  $homepath="index.php";
} else {
  $basePath = '../';
  $homepath="../";
}
?>
<!-- Full-screen Modal -->
<div class="modal fade" id="writercategoriesmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content bg-dark">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-warning h4 fw-bold" id="exampleModalLabel">Categories</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Dropdown content -->
        <div class="container-fluid bg-dark">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 masterrow">
                
             <div class="col bg-dark">
              <div class="card shadow text-light bg-dark border  mb-3  newcategorycard" style="max-height:200px;height:200px;">
              <div class="card-header fw-bold text-warning">New Category</div>
              <div class="card-body hoverchange">
              <p class="card-text "> Create A New Category</p>
              </div>
              </div>
              </div>
                
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
              <div class="card shadow text-light bg-dark border mb-3 selectedCategory" data-randid='.$categoryRandid.' data-name='.$categoryName.' style="max-height:200px;height:200px;">
            <div class="card-header fw-bold text-warning"> ' . $categoryName . '</div>
           <div class="card-body hoverchange">
              <p class="card-text ">' . $ellipsizedText . ' </p>
             </div>
              </div>
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