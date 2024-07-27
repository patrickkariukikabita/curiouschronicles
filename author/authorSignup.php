<?php 
// Initialize the session
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
// handling google signup
$authUrl = $client->createAuthUrl();
$_SESSION['action'] = 'signup';
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
  <title><?php echo "Author Signup - " . $sitename; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <meta name="google-signin-client_id" content="406634251921-ala2u6h8eg7irj5frdvsrha9lf2quani.apps.googleusercontent.com">
  <link rel="stylesheet" href="../menu/menu.css">

</head>

<body class="custom-gray" data-googleurl=<?php echo $authUrl?>>
<?php include "../menu/menu.php";?>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
      </div>

      <div class=" col-lg-5  ">
        <div class="d-flex align-content-center justify-content-center my-3 fw-bold h3 text-orange">
          Author Signup
        </div>
        <div class="login-form custom-gray">
          <form class="border border-transparent p-3 bg-white mx-4">
            <div class="mb-3">
              <label for="full_name" class="form-label labels bodyFont"><i class="fa fa-fw fa-user text-orange"></i> Full Name</label>
              <input type="text" class="form-control full_name" id="full_name" placeholder="Enter full name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label labels bodyFont"><i class="fa fa-fw fa-envelope-o text-orange"></i> Email</label>
              <input type="email" class="form-control email" id="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label labels bodyFont"><i class="fa fa-fw fa-key text-orange"></i> Password</label>
              <div class="input-group">
                <input type="password" class="form-control password" id="password" placeholder="Enter password" required>
                <button class="btn btn-outline-secondary showPasswordBtn border-left-0 border" type="button" id="showPasswordBtn">
                  <i class="fa fa-eye"></i>
                </button>
              </div>
            </div>
           
            <div class="mb-3 form-check">
              <div class="messagediv mt-1 d-flex justify-content-center align-items-center" style="word-wrap:break-word;"></div>
            </div>
            <div class="mb-3">
              <button type="button" class="btn btn-primary w-100 signupbtn"> <i class="fa fa-user-plus"> </i> Create Account</button>
            </div>
            <div class="mb-3">
              <button type="button" class="btn btn-primary mt-3 btn-danger w-100 googlesignupbtn"> <i class="fa fa-google"> </i> Sign Up With Google</button>
            </div>
          </form>
          <div class="my-5 d-flex justify-content-center align-content-center">
            <p class="bodyFont">Already A Writer? <a href="authorLogin.php">Sign In</a></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 ">
        <!-- categories come here-->
        <div class="categoriesdiv"></div>
      </div>
    </div>
  </div>


<?php include"../menu/footer.php"?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://accounts.google.com/gsi/client" async></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../resources/notify.min.js"></script>
   <script src="../menu/menu.js?v=<?php echo time?>"></script>
    <script>
    menuPropagation()
  </script>
  <script>
    $(document).ready(function() {
     
// handling login 
$(".signupbtn").click(function(){
  var email=$(".email").val().trim();
  var password=$(".password").val().trim();
  var full_name=$(".full_name").val().trim()
  

 var hasError=false
 if (email===""|| email.length<3) {
  $(".email").val("").addClass("border border-danger")
  hasError=true
 }else{
    $(".email").removeClass("border border-danger") 
 }
 if (password===""|| password.length<3) {
  $(".password").val("").addClass("border border-danger")
      hasError =true
 }else{
    $(".password").removeClass("border border-danger") 
 }
 if (full_name===""|| full_name.length<3) {
  $(".full_name").val("").addClass("border border-danger")
      hasError =true
 }else{
    $(".full_name").removeClass("border border-danger") 
 }
  // check if there is error
  if(!hasError){
       // send an ajax_request
       $.ajax({
      url:"signupController.php",
      method:"POST",
      data:{password:password,email:email,full_name:full_name},
      beforeSend:function(){
        $(".messagediv").html('<p class="text-primary"><i class="fa fa-spinner fa-spin text-primary"></i> Authenticating ...</p>')
      },
      success:function(response){
        var parsedResponse = JSON.parse(response);
        if (parsedResponse.status == 1) {
          $(".messagediv").html('<p class="text-success"><i class="fa fa-check text-success"></i> Account Created . Redirecting ...</p>');
          $.notify('Account Created: ' , {
            position: 'top left',
            autoHideDelay: 2000, 
            className: 'success' 
          }); 
          
          setTimeout(function() {
            window.location.href = 'verifyEmail.php?author=' + parsedResponse.author_randid;
          }, 2000);
        }else if(parsedResponse.status==2){
          $(".messagediv").html('<p class="text-danger"><i class="fa fa-times text-danger"></i> Signup Failed. User Already Exists </p>')
        $(".password").val("")
        $.notify('Error Creating Account: ' , {
            position: 'top left',
            autoHideDelay: 6000, 
            className: 'error' 
          });
        }else{
          $(".messagediv").html('<p class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i> An Error Occured, Please Try Again. </p>')
        }

      },
      error:function(){
        $(".messagediv").html('<p class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i> An Error Occured, Please Check Connection. </p>')
        $(".password").val("")
        $.notify('Please Check Connection and try Again. ' , {
            position: 'top left',
            autoHideDelay: 6000, 
            className: 'error' 
          });
      }
    });
  }else{
   return
  }
 
  
})

// password show and hide
$('.showPasswordBtn').click(function() {
      var passwordInput = $('.password');
      if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text');
        $(this).html('<i class="fa fa-eye-slash"></i>'); // Change the icon to indicate hiding password
      } else {
        passwordInput.attr('type', 'password');
        $(this).html('<i class="fa fa-eye"></i>'); // Change the icon to indicate showing password
      }
    });
  

// google sign Up
$(".googlesignupbtn").click(()=>{
    var googleUrl=$("body").data("googleurl")
 window.location.href=googleUrl
})


    });
  
</script>
</body>
</html>
