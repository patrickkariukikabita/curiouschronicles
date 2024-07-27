<?php 
// Initialize the session
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
//Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_GET["author"]) && $_SESSION['loggedin']===true){
// get the email of the user
 $authorrandid = clean($_GET['author']);
  $query="select full_name,email,active_status from authors where author_randid=?";
  $stmt=$conn->prepare($query);
  $stmt->execute([$authorrandid]);
  $result=$stmt->fetch(PDO::FETCH_ASSOC);
  $authorname= $result['full_name'];
 $email= $result['email'];
      $active_status= $result['active_status'];
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
  Verify Email
        </div>
      <div class="login-form headingFont">
              <div class="my-4 statusdiv">
             Please check your inbox to verify your email. Verifying your email activates your  <?php echo ucwords($sitename)?> author account.
              </div>
              <div class="my-4  text-center bodyFont">
            Didn't receive email? 
              </div>
             <div class="my-4  text-center bodyFont">
            Click the button below to resend the verification Email.
              </div>
         
           
            <div class="mb-5 mt-5">
              <button type="button" class="btn btn-primary w-100 resendemailbtn headingFont"><i class="fa fa-envelope-o"></i> Resend Email</button>
            </div>
       </div>
       
      </div>
      </div>
      <!-- Side widgets-->
      <div class="col-lg-3 d-none d-lg-block"></div>

    </div>
  </div>



<?php include"../menu/footer.php"?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../resources/notify.min.js"></script>
     <script src="../menu/menu.js?v=<?php echo time?>"></script>
      <script>
    menuPropagation()
  </script>
  <script>
    $(document).ready(function() {
        window.author=$("body").data("author");
        
        resendVerificationEmail();

    function resendVerificationEmail(){
        var email = $("body").data("email");
    // Send AJAX request
    $.ajax({
      url: "signupController.php",
      method: "POST",
      data: {
        email: email,
        author: author
      },beforeSend:function(){
            $.notify('Resending Verification Email ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'warning' 
          }); 
      },
      success: function(response) {
          if(response==1){
        // Handle the response from signupController.php
          $.notify('Verification Email Sent. ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'success' 
          }); 
           $(".statusdiv").html('<p class="text-dark headingFont">A verification Email has been sent to : <span class="text-muted bodyFont">' +hideEmail(email) +'</span> Please check your email.</p>')
      }else{
            // Handle any error that occurs during the AJAX request
          $.notify('Error Sending Email ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'error' 
          });
           $(".statusdiv").html('<p class="text-danger headingFont">Error sending email. Please try again later.</p>')
      }
      },
      error: function(xhr, status, error) {
        // Handle any error that occurs during the AJAX request
          $.notify('Error Sending Email ' , {
            position: 'top left',
            autoHideDelay: 5000, 
            className: 'error' 
          }); 
             $(".statusdiv").html('<p class="text-danger headingFont">Error sending email. Check your Connection.</p>')
      }
    });
        
    }
    $(".resendemailbtn").click(function(){
          resendVerificationEmail();  
    })
    //end of resending mail
    
    
function hideEmail(email) {
    const atIndex = email.indexOf('@');
    const username = email.substr(0, 2);
    const domain = email.substr(atIndex);
    const hiddenPart = '*'.repeat(atIndex - 2);
    const endPart = email.substr(atIndex - 3, 3);
    return username + hiddenPart + endPart + domain;
}

// continously check if the user has activated account after 3 seconds
// Function to make the AJAX call and handle the response
function checkAccountStatus() {
    $.ajax({
        url: "activeStatusChecker.php",
        method: "POST",
        data: {
            author: author
        },
        success: function (response) {
            if (response == 1) {
                // Handle the response from signupController.php
                $.notify('Account Active. Redirecting...', {
                    position: 'top left',
                    autoHideDelay: 2000,
                    className: 'success'
                });
                setTimeout(function () {
                    window.location.replace("authorHome.php?author=" + author);
                }, 3000);
            }
        },
        error: function (xhr, status, error) {
            // Handle any error that occurs during the AJAX request
            $.notify('Please check your internet connection', {
                position: 'top left',
                autoHideDelay: 5000,
                className: 'error'
            });
        }
    });
}

// Call the function initially
checkAccountStatus();

// Call the function every 3 seconds using setInterval
setInterval(function () {
    checkAccountStatus();
}, 3000); // 3000 milliseconds = 3 seconds

   


    });
  </script>
</body>
</html>
