<?php 
// Initialize the session
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
//Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_GET["token"]) && !empty($_GET['token'])&& $_SERVER["REQUEST_METHOD"]=="GET"){
// get the email of the user
 $emailtoken = clean($_GET['token']);
 $checkQuery = "SELECT author_randid  FROM email_verification_tokens WHERE email_token = ?";
$checkStmt = $conn->prepare($checkQuery);
$checkStmt->execute([$emailtoken]);
if ($checkStmt->rowCount() > 0) {
    $result=$checkStmt->fetch(PDO::FETCH_ASSOC);
    $authorrandid=$result['author_randid'];
 $query="update authors set active_status=? where author_randid=? ";
  $stmt=$conn->prepare($query);
  $stmt->execute(['yes',$authorrandid]);
//  redirect the user to user home after
}else{
      header('location:authorLogin.php');
    exit;
}
}else{
    header('location:authorLogin.php');
    exit;
}

// if the email comes from email that was sent
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="HandheldFriendly" content="true">
  <link rel="icon" type="image/x-icon" href="../logos/favicon.ico" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title><?php echo "Verify Email - " . $sitename; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7410297700829623"
     crossorigin="anonymous"></script>
     <meta name="google-signin-client_id" content="406634251921-ala2u6h8eg7irj5frdvsrha9lf2quani.apps.googleusercontent.com">
     <script src="https://apis.google.com/js/platform.js" async defer></script>
  <link rel="stylesheet" href="../menu/menu.css">

</head>
  <body class='custom-gray' data-email="<?php echo $email?>" data-author="<?php echo $authorrandid?>">
<!-- including top menu file  -->
<?php include "../menu/menu.php";?>
<!-- the page contennt goes here -->
  <div class="container ">
    <div class="row ">
      <!-- creating the middle piece the article comes here-->
      <div class="col-lg-3 "></div>
      <div class="col-lg-5">
      <!-- the content comes here -->

      <!--modify the -->
      <div class=" custom-gray " >
      <div class='d-flex align-content-center justify-content-center my-3 fw-bold h3 text-orange '>
  Verifying Your Writer Account
        </div>
     <div class=" headingFont">
    <div class="my-4 statusdiv">
        Thank you for joining the <?php echo $sitename?> blog. We appreciate your interest.
        <br>Please wait patiently as we verify your account .
    </div>
    <div class="my-4 text-center bodyFont">
        <!-- Use Bootstrap 5 spinner-border class for spinning effect and Bootstrap 5 text classes for color -->
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

       
      </div>
      </div>
      <!-- Side widgets-->
      <div class="col-lg-3 d-none d-lg-block"></div>

    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../resources/notify.min.js"></script>
     <script src="../menu/menu.js"></script>
      <script>
    menuPropagation()
  </script>
  <script>
    $(document).ready(function() {
     var author=$("body").data("author");
    // Send AJAX request
    $.ajax({
      url: "activeStatusChecker.php",
      method: "POST",
      data: {
        author: author
      },beforeSend:function(){
            $.notify('Getting Account Status' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'info' 
          }); 
      },
      success: function(response) {
          if(response==1){
        // Handle the response from signupController.php
          $.notify('Account Active. Redirecting... ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'success' 
          }); 
          setTimeout(function () {
             window.location.replace("authorHome.php?author=" + author);
            }, 5000);
      }else{
            // Handle any error that occurs during the AJAX request
          $.notify('Error Verifying Account. Please Request Email . ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'error' 
          });
      }
      },
      error: function(xhr, status, error) {
        // Handle any error that occurs during the AJAX request
          $.notify('Please check your internet connection ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'error' 
          }); 
      }
    });

    //end of resending mail
    
    



    });
  </script>
</body>
</html>
