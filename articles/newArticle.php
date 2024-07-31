<?php
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
error_log(print_r($_POST, true));
if(isset($_GET['author'])&& isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true
 && $_SESSION['author_randid']==clean($_GET['author'])){
  $authorrandid=clean($_SESSION['author_randid']);
}
else{
  // missing query parameter
  header('location:../author/authorLogin.php');
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
    <?php echo "Create Article -" . $sitename; ?>
  </title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.tiny.cloud/1/[Your tinymce token]/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
  <link rel="stylesheet" href="../menu/menu.css">
  <style>
  .custom-bg{
      background-color:#222f3e;
  }
  /* Default styles for desktop and larger screens */
.editor-wrapper {
    margin-left: 15%;
    margin-right: 15%;
}

/* Fullscreen styles for tablets and phones */
@media (max-width: 1200px) { /* This will cover most tablets and phones */
    .editor-wrapper {
        margin-left: 0;
        margin-right: 0;
    }
}


  </style>
  <script>
    tinymce.init({
      selector: '#tinymceContainer',
       width: '100%',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      images_upload_url: 'ArticleContentImageUpload.php',//subject to change, change 
      image_dimensions: true, // Enable image dimensions
      image_default_width: 400, // Default width for images
      image_default_height: 300, // Default height for images
      skin: 'oxide-dark',
   
    });
  </script>
  
  
  
</head>
<body class='custom-bg' data-authorrandid="<?php echo $authorrandid?>">
  <!-- handling the editor tinyMCE -->

<div class="container-fluid custom-bg py-2">
    <div class="row">
        <div class="col-12 d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-center">

            <!-- Title Input on its own row for small and medium devices -->
            <div class="col-12 col-lg-auto mb-2 mb-lg-0">
                <input class="form-control myinput border text-dark fw-bold" id="title" title="Article Title" placeholder="Article Title" style="max-width:100%; width:400px;">
            </div>

            <!-- Categories and Cover on the same row for small and medium devices -->
            <div class="col-12 col-lg-auto d-flex flex-wrap justify-content-between align-items-center mb-2 mb-lg-0">
                <button class="mybutton btn btn-transparent text-light fw-bold px-3 hoverchange categoryselectorbutton  mx-lg-2 mb-2 mb-lg-0" type="button"> <i class="fa fa-folder"></i> <span class="categoryspan">Category<span> 
                </button>
                <button class="mybutton articleimg btn-transparent shadow hoverchange btn text-light fw-bold px-3  mx-lg-2" title="Article cover Image ">
                    <i class="fa fa-camera text-light icons mx-1"> </i>  Cover
                    <span class="imagespan fa fa-check text-success d-none"><span>
                </button>
            </div>

            

            <!-- Preview and Save on their own row for small and medium devices -->
            <div class="col-12 col-lg-auto d-flex justify-content-between align-items-center mb-2 mb-lg-0">
                
                
                   <div class="form-check form-switch myinput d-flex justify-content-center align-items-center mx-2 ">
                    <input class="form-check-input toggle-btn" type="checkbox" id="flexSwitchCheckDefault" checked>
                    <label class="form-check-label toggle-btn-label mx-2 fw-bold" for="flexSwitchCheckDefault">Published</label>
                </div>
                <!--save and preview button-->
                 <button class="mybutton btn btn-transparent text-light fw-bold hoverchange px-3 " id="previewBtn">
                    <i class="fa fa-eye icons text-light mx-1"> </i>Preview </button>
                <button class="mybutton btn btn-transparent text-light fw-bold hoverchange mx-2 px-3" id="exportBtn">
                    <i class="fa fa-save icons text-light mx-1"> </i> Save </button>
            </div>

        </div>
    </div>
</div>




<!--for getting the aricle cover-->
<input type="file" style="display: none;" class="form-control myinput" id="articleimageInput" name="articleimagefile" accept="image/*" required>

<!-- the editing field textarea -->
<!--<div class="container-fluid custom-bg" style="text-align: center;">-->
<!--    <textarea id="tinymceContainer" style='height:60vh; width:80%;'> Tell A Story...-->
<!--    </textarea>-->
<!--</div>-->

<div class="container-fluid custom-bg">
    <div class="px-2 editor-wrapper" style="height:80vh;" >
        <textarea id="tinymceContainer" style="height:100%;">Tell A Story...</textarea>
    </div>
</div>



  <!-- Modal for uploading category image-->
  <div class="modal fade" id="newcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
          <button type="button" class="mybutton btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="imageUploadForm" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="categoryInput" class="form-label">Category Name</label>
              <input type="text" class="form-control myinput" id="categoryInput" name="category" required>
            </div>
            <div class="mb-3">
              <label for="descinput" class="form-label">Category Description</label>
              <input type="text" class="form-control myinput" id="descinput" name="category" required>
            </div>
            <div class="mb-3">
              <label for="imageInput" class="form-label">Image</label>
              <input type="file" class="form-control myinput" id="imageInput" name="imageFile" accept="image/*" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="mybutton btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="mybutton btn btn-primary" id="uploadBtn">Upload</button>
        </div>
      </div>
    </div>
  </div>

<!--handling article restoration-->
<!-- Restore Modal -->
<div class="modal fade custom-bg" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
  <div class="modal-dialog border-0">
    <div class="modal-content border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title border-0 lead" id="restoreModalLabel">Restore Article</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border-0">
    It appears you have an unfinished article draft from your previous session. Would you like to continue where you left off?
    </div>
      <div class="modal-footer d-flex justify-content-between border-0 align-items-center">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="discardBtn">Discard</button>
        <button type="button" class="btn btn-success" id="restoreBtn">Restore</button>
      </div>
    </div>
  </div>
</div>




  <!-- preview of the article before publishing if need be-->
  <div class="container-fluid custom-bg mt-2" id="previewContainer">
      <!-- articles come here -->
      <div class="editor-wrapper bg-light px-3">
            <div class=" p-3">
                    <div class="fw-bold justify-content-between align-items-center text-dark h2 text-center" 
                    id="titlediv" style="word-wrap: break-word; padding: 10px;">
                  </div>
                  <div class="mb-3 img_placeholder d-none">
                      <img src="" style="width: 98%; height:400px;" class="img-fluid articleimagepreview" >
                  </div>
            </div>
            <div class='mx-2 my-2 articleFont ' id="exportedContent">
        </div>
     </div>
  </div>

 <?php 
 include "../menu/footer.php";
 include "categoryPopUpModal.php";?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>

    //  handling the events
    $(document).ready(function () {
      window.author_randid=$("body").data("authorrandid")
      window.category_randid="";
    
      // Check if there's data in local storage
    if (localStorage.getItem('savedContent') || localStorage.getItem('savedTitle')) {
        // Display the modal
        $('#restoreModal').modal('show');
    }
    
    // In the modal's "Restore" button click event:
$('#restoreBtn').click(function() {
    // Restore the saved data from local storage
    tinymce.get('tinymceContainer').setContent(localStorage.getItem('savedContent'));
    $('#title').val(localStorage.getItem('savedTitle'));
     // Programmatically click the category with the saved randid
    var savedRandid = localStorage.getItem('savedCategory');
    if (savedRandid) {
        $(".selectedCategory[data-randid='" + savedRandid + "']").click();
    }else{
        $('.categoryselectorbutton').addClass('border-2 border-danger');
    }
    $('.articleimg').addClass('border-2 border-danger');
    // we will not be storing image cover to local storage due to size limits
    // Close the modal
    $('#restoreModal').modal('hide');
});

// In the modal's "Discard" button click event:
$('#discardBtn').click(function() {
    // Clear the saved data from local storage
    localStorage.removeItem('savedContent');
    localStorage.removeItem('savedTitle');
    localStorage.removeItem('savedCategory');
    // Close the modal
    $('#restoreModal').modal('hide');
});


setInterval(function() {
    // Get data from the text area, selected category, title
    // we will not be storing the title cover due tolocal storage size limits
    var content = tinymce.get('tinymceContainer').getContent();
    // if content is not tell a story and work has been done
    if(content.length>=50){
     var title = $('#title').val();
    var category = $('.selectedCategory').data('randid');
    // Save the data to local storage
    localStorage.setItem('savedContent', content);
    localStorage.setItem('savedTitle', title);
    localStorage.setItem('savedCategory', category);  
    }
}, 60000); // 60000ms = 1 minute



      // handling category image upload
      $('#uploadBtn').click(function () {
        var category_name = $('#categoryInput').val().trim();
        var description = $('#descinput').val().trim();
        // Check if the form is valid
        if ($('#imageUploadForm')[0].checkValidity()) {
          // Create a FormData object
          var formData = new FormData($('#imageUploadForm')[0]);
          formData.append('category_name', category_name);
          formData.append('description', description);
          // Send the image data to the PHP script using AJAX
          $.ajax({
            type: 'POST',
            url: '../categories/newCategoryController.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
              if (response == -2) {
                    $.notify('Check Provided Data ' , {
                    position: 'top left',
                    autoHideDelay: 5000, 
                    className: 'error' 
                  });
              }
              else if (response == -1) {
                       $.notify('Invalid Image File ' , {
                    position: 'top left',
                    autoHideDelay: 5000, 
                    className: 'error' 
                  });
              }
              else if (response == 0) {
             $.notify('Error Saving Image ' , {
                    position: 'top left',
                    autoHideDelay: 5000, 
                    className: 'error' 
                  });
              }
              else if (response == -3) {
                   $.notify('Category  Exist ' , {
                    position: 'top left',
                    autoHideDelay: 5000, 
                    className: 'error' 
                  });
              }
              else {
                category_randid = response;
                $.notify('Category Added Successfully' , {
                    position: 'top left',
                    autoHideDelay: 5000, 
                    className: 'success' 
                  });
                  
                //   add the newly added category to the categories
            var newOption='<div class="col bg-dark"><div class="card shadow text-light bg-dark border border-warning mb-3 selectedCategory" data-randid="' + category_randid + '" data-name="'+category_name+'" style="max-height:200px;height:200px;"><div class="card-header fw-bold text-warning">' + category_name + '</div><div class="card-body hoverchange"><p class="card-text text-warning"> ' + description + '</p></div></div> </div>';
                $(".categoryspan").html(category_name)
                // Insert the new card as the second item in .masterrow
                $(newOption).insertAfter($(".masterrow").children().eq(0));
                // hide the modal
                // Get the modal element
                var modal = document.getElementById('newcategoryModal');
                // Wait for 1 second and then hide the modal
                setTimeout(function () {
                  var modalInstance = bootstrap.Modal.getInstance(modal);
                  if (modalInstance) {
                    modalInstance.hide();
                  }
                }, 1000);
              }
            },
            error: function (xhr, status, error) {
                  $.notify('Please Check Your Connection ' , {
                    position: 'top left',
                    autoHideDelay: 5000, 
                    className: 'error' 
                  });
            }
          });
        } else {
          // Form is invalid, display error or take appropriate action
               $.notify('Errors Present in the Submitted Data.' , {
                    position: 'top left',
                    autoHideDelay: 5000, 
                    className: 'error' 
                  });
        }
      });

     var publishedstatus = true; // Set initial status
    // Set initial state
    $('#flexSwitchCheckDefault').prop('checked', publishedstatus);
    updateToggleColor();
    // Toggle button event listener
    $('#flexSwitchCheckDefault').change(function() {
      publishedstatus = $(this).is(':checked');
      updateToggleColor();
    });

    // Function to update toggle button color
    function updateToggleColor() {
      var backgroundColor = publishedstatus ? 'green' : 'gray';
      var labeltext= publishedstatus ? 'Published' : 'Unpublished';
      $('.toggle-btn').next('.toggle-btn-label').css('color', backgroundColor).text(labeltext);
      $('.toggle-btn').css('background-color', backgroundColor);
    }




 var articleformData; // Declare the variable outside of any function scope
// Get the selected image
$(".articleimg").click(function () {
  $('#articleimageInput').click();
});

// Create FormData object and append selected image when input field changes
window.isselectedcover = false;
$('#articleimageInput').change(function () {
    var fileInput = $(this)[0];
    if (fileInput.files && fileInput.files[0]) {
        var fileType = fileInput.files[0].type;
        // Define the allowed image types
        var allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
        // Check if the selected image type is allowed
        if (!allowedImageTypes.includes(fileType)) {
            // If not, add the border class to the .articleimg element
            $('.articleimg').addClass('border-2 border-danger');
            isselectedcover = false;
            // Notify the user about the invalid image type
            $.notify('Invalid image type. Please select a JPG, PNG, GIF,SVG or WEBP image.', {
                position: 'top left',
                autoHideDelay: 5000,
                className: 'error'
            });
            return; // Exit the function early since the image type is invalid
        }
        // If the image type is valid, proceed with the existing logic
        articleformData = new FormData();
        articleformData.append('articleimagefile', fileInput.files[0]);
        // Find the <img> tag with class "articleimagepreview"
        var imagePreview = $('.articleimagepreview');
        // Create a FileReader object to read the selected file
        var reader = new FileReader();
        // Set a callback function to be executed when the image is loaded
        reader.onload = function (e) {
            // Set the source of the <img> tag to the loaded image data
            imagePreview.attr('src', e.target.result);
            isselectedcover = true;
            $('.articleimg').removeClass('border-2 border-danger');
             $('.imagespan').removeClass('d-none');
        };
        // Read the selected file as a data URL
        reader.readAsDataURL(fileInput.files[0]);
    } else {
        isselectedcover = false;
         $('.imagespan').addClass('d-none');
    }
});


$("#title").on("keyup keydown input", function() {
  var title = $('#title').val();
  $('#title').val(capitalizeWords(title))
});


function capitalizeWords(str) {
  // Convert the string to lowercase
//   str = str.toLowerCase();
  // Split the string into an array of words
  var words = str.split(' ');
  // Capitalize the first letter of each word
  for (var i = 0; i < words.length; i++) {
    var word = words[i];
    // Capitalize the first letter of the word
    var capitalizedWord = word.charAt(0).toUpperCase() + word.slice(1);
    // Replace the word in the array with the capitalized version
    words[i] = capitalizedWord;
  }
  // Join the words back into a single string
  var capitalizedString = words.join(' ');
  
  return capitalizedString;
}


function checkForErrors() {
  var title = $('#title').val().trim();
  var hasError = false;
  if (category_randid === '') {
    $('.categoryselectorbutton').addClass('border-2 border-danger');
    hasError = true;
  } else {
    $('.categoryselectorbutton').removeClass('border-2 border-danger');
  }

  if (title === '') {
    $('#title').addClass('border-2 border-danger').focus();
    hasError = true;
  } else {
    $('#title').removeClass('border-2 border-danger');
  }

  if (!isselectedcover) {
    $('.articleimg').addClass('border-2 border-danger');
     $('.imagespan').addClass('d-none');
    hasError = true;
  } else {
    $('.articleimg').removeClass('border-2 border-danger');
     $('.imagespan').removeClass('d-none');
  }

  if (hasError) {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
  }

  return hasError;
}

// Preview button click event
$('#previewBtn').click(function () {
  if (checkForErrors()) {
    $.notify('Missing Input Fields ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'error' 
          });
    return;
  }

  var title = $('#title').val().trim();
   if (title.charAt(title.length - 1) !== '.') {
    // Add a full stop at the end
    title += '.';
  }
  var editor = tinymce.get('tinymceContainer');

  if (editor) {
    var content = editor.getContent();
    $('#exportedContent').html(content);
    $("#titlediv").html(title)
    $(".img_placeholder").removeClass("d-none")
    $('html, body').animate({
        scrollTop: $("#previewContainer").offset().top
    }, 1000); // 1000ms for a smooth scroll effect
  }
});



// Export button click event
$('#exportBtn').click(function () {
  if (checkForErrors()) {
    $.notify('Missing Input Fields ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'error' 
          });
    return;
  }

  var title = $('#title').val().trim();
   if (title.charAt(title.length - 1) !== '.') {
    // Add a full stop at the end
    title += '.';
  }
  var editor = tinymce.get('tinymceContainer');
  var hasError = false;

  if (editor) {
    var content = editor.getContent();
    // Append content to the formData
    articleformData.append('category_randid', category_randid);
    articleformData.append('title', title);
    articleformData.append('content', content);
    articleformData.append('publishedstatus', publishedstatus);
    articleformData.append('author_randid', author_randid);
    // Export the content and formData
    $.ajax({
      url: 'newArticleController.php',
      method: 'POST',
      data: articleformData,
      processData: false,
      contentType: false,
      beforeSend: function() {
        $.notify('Saving Article ... ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'info' 
          });
      },
      success: function (response) {
          if(response==1){
             $.notify('Article Saved Successfuly... Redirrecting' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'success' 
          });
        // Clear the saved data from local storage
        localStorage.removeItem('savedContent');
        localStorage.removeItem('savedTitle');
        localStorage.removeItem('savedCategory');
       setTimeout(function() {
          window.location.replace("../author/authorHome.php?author=" + author_randid);
        }, 5000);  
          }else{
              $.notify('An Occured saving Article. Please Contact the Admin' , {
            position: 'top left',
            autoHideDelay: 10000, 
            className: 'warning' 
          });
          }
      },
      error: function (xhr, status, error) {
        $.notify('A Network Error Occured Performing Operation' , {
            position: 'top left',
            autoHideDelay: 10000, 
            className: 'error' 
          });
      }
    });
  }
});

// showing categories modal
$(".categoryselectorbutton").click(()=>{
    $("#writercategoriesmodal").modal('show')
})

$(".selectedCategory").click(function(){
   category_randid=$(this).data("randid")
   $(".categoryspan").html($(this).data("name"))
//   add a border to this selected category
    $('.selectedCategory').removeClass('border-warning');
    // Add 'border-warning' class to the clicked card
    $(this).addClass('border-warning');
    // Change the text color of '.card-text' to 'text-warning' for the clicked card
    $(this).find('.card-text').addClass('text-warning');
    // Remove 'text-warning' class from other '.card-text' elements
    $('.selectedCategory .card-text').not($(this).find('.card-text')).removeClass('text-warning');
        // hide this modal
 $("#writercategoriesmodal").modal('hide')
})

$(".newcategorycard").click(function(){
//   creating a new category
$('#newcategoryModal').modal('show');
$("#writercategoriesmodal").modal('hide')
})

// disable text selection for category cards
 $(".card-text").on("selectstart", function (e) {
            e.preventDefault();
});

// end of document ready
    });
  </script>
</body>
</html>