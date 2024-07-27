<?php
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
if(isset($_SESSION['loggedin'], $_SESSION['author_randid'])&& $_SESSION['loggedin']==true){
  $authorrandid=clean($_SESSION['author_randid']);
}
else{
  // missing query parameter
  header('location:../author/authorLogin.php');
  exit;
}
// check if the article wanting to be edited exists
if(isset($_GET['art'])){
  $article_randid=clean($_GET['art']);
   // Your PHP logic here to fetch and loop through items
   $stmt = $conn->prepare("SELECT * from articles 
   inner join categories on articles.category_randid=categories.category_randid  where article_randid=? ");
   $stmt->execute([$article_randid]);
   if ($stmt->rowCount() > 0) {
     $article = $stmt->fetch(PDO::FETCH_ASSOC);
       $title = $article['title'];
       $content = $article['content'];
       $category_randid = $article['category_randid'];
       $article_randid = $article['article_randid'];
       $categoryName=$article['category_name'];
       $cover = $article['article_cover'];
       $publishstatus = $article['publishstatus'];
}// article not found
else{
    header('location:../error/error.php');
    exit;
}
}
else{
  // missing query parameter
  header('location:../error/error.php');
  exit;
}
// check if the article wanting to be edited exists

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
    <?php echo "Modify Article -" . $sitename; ?>
  </title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.tiny.cloud/1/4u1uuliyidc8mn97a5t2dz2i4y6e2noa7q0edmzugnb1qicy/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#tinymceContainer',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      images_upload_url: 'ArticleContentImageUpload.php',//subject to change, change 
      image_dimensions: true, // Enable image dimensions
      image_default_width: 400, // Default width for images
      image_default_height: 300, // Default height for images
      skin: 'oxide-dark',
   
    });
  </script>
   <link rel="stylesheet" href="../menu/menu.css">
</head>

<body class='custom-gray' data-authorrandid="<?php echo $authorrandid?>"data-articlerandid="<?php echo $article_randid?>">
<!-- including top menu file  -->
  <!-- handling the editor tinyMCE -->
  <div class="container-fluid bg-light">
  <div class="row">
    <div class="col-lg-5 col-md-12 d-flex justify-content-center bg-light align-items-center mx-2 py-1">
      <input class="form-control myinput border border-secondary text-dark fw-bold me-2" id="title" title="Article Title --Required"
        style="width:35%;" placeholder="Article Title --Required" value="<?php echo $title?>">
      <?php
      // Retrieve categories from the table
      $query = "SELECT category_randid, category_name FROM categories";
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
      // Create the select box with the desired style
      echo '<select id="category" class="form-select text-dark fw-bold myselect border border-secondary" title="Article Category --Required" 
      style="width:25%;" name="category">
      <option value="'.$category_randid.'">'.$categoryName.'</option>';
      foreach ($categories as $category) {
        $category_randid = $category['category_randid'];
        $categoryName = $category['category_name'];
        echo '<option value="' . $category_randid . '">' . $categoryName . '</option>';
      }
      // Add the option to add a new category
      echo '<option value="new">Add New Category</option>';
      echo '</select>';
      ?>
      <input type="file" style="display: none;" class="form-control" id="articleimageInput" name="articleimagefile" accept="image/*" required>
      <button class="articleimg mybutton btn-secondary btn  mx-2 text-light btn-sm rounded-pill fw-bold px-3" style="width:25%;" title="Article cover Image --Required"
       data-bs-toggle="modal" data-bs-target="#articleimgmodal">
        <i class="fa fa-camera text-light icons mx-1"> </i> Cover
      </button>
    </div>
    <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-evenly align-items-center py-1">
      <!-- Handling the publish flexSwitchCheckDefault -->
      <div class="form-check form-switch d-flex justify-content-left  align-items-center mx-2 rounded-pill">
        <input class="form-check-input myinput toggle-btn my-1" type="checkbox" id="flexSwitchCheckDefault">
        <label class="form-check-label toggle-btn-label mx-2 fw-bold" for="flexSwitchCheckDefault"></label>
      </div>
      <button class=" mybutton btn btn-outline-secondary btn-success btn-sm mx-2 rounded-pill text-light fw-bold px-3" id="previewBtn">
         <i class="fa fa-eye icons text-light mx-1"> </i>Preview </button>
      <button class="mybutton btn btn-outline-secondary btn-primary btn-sm mx-2 rounded-pill text-light fw-bold px-3" id="updateExportBtn">
         <i class="fa fa-save icons text-light mx-1"> </i> Update </button>
    </div>
  </div>
</div>




<!-- setting text to the tinymce textarea -->
<div class="container-fluid">
    <textarea id="tinymceContainer" style='height:60vh;'> <?php echo $content?>
  </textarea>
</div>


  <!-- Modal for uploading category image-->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
          <button type="button" class="btn-close mybutton" data-bs-dismiss="modal" aria-label="Close"></button>
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
          <button type="button" class="btn btn-secondary mybutton" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary mybutton" id="uploadBtn">Upload</button>
        </div>
      </div>
    </div>
  </div>

  <!-- preview of the article before publishing if need be-->
  <div class="container-fluid">
    <div class="row" >
      <div class="col-md-2 d-none d-md-block custom-gray ">
        <!-- ads come here-->
        <div class='categoriesdiv '>
        </div>
      </div>

      <!-- articles come here -->
      <div class="col-12 col-md-8 bg-light " style="padding-left: 0; padding-right: 0;">
        
            <div class=" p-3">
                    <div class="fw-bold justify-content-between align-items-center text-dark h2 text-center" 
                    id="titlediv" style="word-wrap: break-word; padding: 10px;">
                  </div>
                  <div class="mb-3 img_placeholder d-none">
                      <img src="" style="width: 98%; height:400px;" class="img-fluid articleimagepreview" >
                  </div>
            </div>
            <div class='mx-2 my-2 articleFont' id="exportedContent">
        </div>
     </div>
      <div class="col-md-2 d-none d-md-block custom-gray ">
        <!-- categories come here-->
        <div class='categoriesdiv  '>
        </div>
      </div>
  </div>
  </div>
  <script src="../resources/notify.min.js"></script>
  <script>

    //  handling the events
    $(document).ready(function () {
      window.author_randid=$("body").data("authorrandid")
      window.article_randid=$("body").data("articlerandid")
      window.category_randid;


      // handling category image upload.
      // Event listener for select box
      $('#category').change(function () {
        // Get the selected value
        var cat_randid = $(this).val();
        category_randid = cat_randid;
        // Check if the selected value is "new"
        if (cat_randid === 'new') {
          // Show the modal
          $('#myModal').modal('show');
        }
      });


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
                   $.notify('Category Already Exists ' , {
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
                        // Append a new option with the new category name to the select box
                var newOption = '<option value="' + category_randid + '">' + category_name + '</option>';
                $('#category').append(newOption);
                // Set the newly added category as the selected item
                $('#category').val(category_randid);
                // hide the modal
                // Get the modal element
                var modal = document.getElementById('myModal');
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

     

     var publishedstatus = <?php echo $publishstatus?>; // Set initial status
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




 window.articleformData; // Declare the variable outside of any function scope
 articleformData = new FormData();
// Get the selected image
$(".articleimg").click(function () {
  $('#articleimageInput').click();
});

// Create FormData object and append selected image when input field changes
window.isselectedcover = false;
$('#articleimageInput').change(function () {
  var fileInput = $(this)[0];
  if (fileInput.files && fileInput.files[0]) {
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
    };
    // Read the selected file as a data URL
    reader.readAsDataURL(fileInput.files[0]);
  } else {
    isselectedcover = false;
  }
});

// Set the image without clicking the button
var coverImagePath = "<?php echo $cover; ?>";
if (coverImagePath) {
  // Find the <img> tag with class "articleimagepreview"
  var imagePreview = $('.articleimagepreview');
  // Set the source of the <img> tag to the cover image path
  imagePreview.attr('src', coverImagePath);
  // Trigger the change event on the file input to update the selected image
  $('#articleimageInput').trigger('change');
  isselectedcover = true;
}


$("#title").on("keyup keydown", function() {
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
  // Return the capitalized string
  return capitalizedString;
}


function checkForErrors() {
  var cat_randid = $('#category option:selected').val().trim();
  category_randid = cat_randid;
  var title = $('#title').val().trim();
  var hasError = false;

  if (category_randid === '') {
    $('#category').addClass('border-2 border-danger').focus();
    hasError = true;
  } else {
    $('#category').removeClass('border-2 border-danger');
  }

  if (title === '') {
    $('#title').addClass('border-2 border-danger').focus();
    hasError = true;
  } else {
    $('#title').removeClass('border-2 border-danger');
  }

  if (!isselectedcover) {
    $('.articleimg').addClass('border-2 border-danger');
    hasError = true;
  } else {
    $('.articleimg').removeClass('border-2 border-danger');
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

  var cat_randid = $('#category option:selected').val().trim();
  category_randid = cat_randid;
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
  }
});

// Export button click event
$('#updateExportBtn').click(function () {
  if (checkForErrors()) {
    $.notify('Missing Input Fields ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'error' 
          });
    return;
  }

  var cat_randid = $('#category option:selected').val().trim();
  category_randid = cat_randid;
  var title = $('#title').val().trim();
   if (title.charAt(title.length - 1) !== '.') {
    // Add a full stop at the end
    title += '.';
  }
  var editor = tinymce.get('tinymceContainer');

  if (editor) {
    var content = editor.getContent();
    // Append content to the formData
    articleformData.append('category_randid', category_randid);
    articleformData.append('title', title);
    articleformData.append('content', content);
    articleformData.append('publishedstatus', publishedstatus);
    articleformData.append('author_randid', author_randid);
    articleformData.append('article_randid',article_randid);
    
    // Export the content and formData
    $.ajax({
      url: 'modifyBlogController.php',
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
        $.notify('Article Modified...Redirecting. ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'success' 
          });
         setTimeout(function() {
          window.location.replace("../author/authorHome.php?author=" + author_randid);
        }, 5000);
        }else{
          $.notify('Error Occured Performing Operation' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'error' 
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


// end of document ready
    });
  </script>
</body>
</html>