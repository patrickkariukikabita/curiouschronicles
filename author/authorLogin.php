<?php 
// Initialize the session
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
//Check if the user is already logged in, if yes then redirect him to welcome page
$authUrl = $client->createAuthUrl();
$_SESSION['action'] = 'login';
if(isset($_SESSION["loggedin"],$_SESSION['author_randid']) && $_SESSION["loggedin"] === true){
header("location:authorHome.php?author=" . $_SESSION['author_randid']);    
exit;
  
}


//check if cookies are set
if (isset($_COOKIE['AuthToken0']) && isset($_COOKIE['AuthToken1'])) {
   //write code to query the database and get user with the above AuthToken0 and AuthToken1
    $cook="select * from AuthorCookies where AuthToken0=? and AuthToken1=?";
    $cookst=$conn->prepare($cook);
    $cookst->execute([$_COOKIE['AuthToken0'],$_COOKIE['AuthToken1']]);
    if ($cookst->rowCount()>0) {
//surely the user exists then log him/her in
        $rs=$cookst->fetch(PDO::FETCH_ASSOC);
        $author_randid=$rs['author_randid'];
        $authToken1=randomToken(90);
//replace the old AuthToken1 value in the database
    $cookinserter="update AuthorCookies set AuthToken1 =?, timestamp=now() where author_randid=?";
    $cookist=$conn->prepare($cookinserter);
    $cookist->execute([$authToken1,$author_randid]);
  #setting the cookies, making them httponly and secure
  setcookie("AuthToken0", $rs['AuthToken0'], time() + (10 * 365 * 24 * 60 * 60), '/', '', true, true);
  setcookie("AuthToken1", $authToken1, time() + (10 * 365 * 24 * 60 * 60), '/', '', true, true);
        $_SESSION["loggedin"] = true;
        $_SESSION['author_randid']=$author_randid;
        header("location:authorHome.php?author=" . $_SESSION['author_randid']);
    exit;
    }
}//end of if cookies are set
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
  <title><?php echo "Author Login - " . $sitename; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../menu/menu.css">

</head>
  <body class='custom-gray' data-googleurl=<?php echo $authUrl?>>
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
       Author Login
        </div>
      <div class="login-form headingFont">
          <form class="border border-transparent  p-3 bg-white mx-4">
              <div class="mb-3">
                <label for="email" class="form-label bodyFont labels"><i class="fa fa-envelope-o text-orange me-1"> </i> Email</label>
                <input type="email" class="form-control email" id="email" placeholder="Enter email" required>
              </div>
            <div class="mb-3">
              <label for="password" class="form-label bodyFont labels"><i class="fa fa-key text-orange me-1"></i> Password</label>
              <div class="input-group">
                <input type="password" class="form-control password" id="password" placeholder="Enter password" required>
                <button class="btn btn-outline-secondary showPasswordBtn border-left-0 border" type="button" id="showPasswordBtn">
                  <i class="fa fa-eye"></i>
                </button>
              </div>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input rememberMe" id="rememberMe"  checked>
              <label class="form-check-label headingFont labels" for="rememberMe">Remember Me</label>
              <div class="messagediv mt-1 d-flex justify-content-center align-items-center" style="word-wrap:break-word;"></div>
            </div>
            <div class="mb-3">
              <button type="button" class="btn btn-primary w-100 loginbtn headingFont"><i class="fa fa-key"></i> Login</button>
            </div>
            <div class="mb-3">
              <button type="button" class="btn btn-primary mt-3 btn-danger w-100 googlesigninbtn"> <i class="fa fa-google"> </i> Sign In With Google</button>
            </div>
     </form>
     <div class="my-5 d-flex justify-content-center align-content-center bodyFont">
      <p>Want To Become A Writer? <a href="authorSignup.php">
      Join Us
      </a>
    </p>  
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
     <script src="../menu/menu.js?v=<?php echo time()?>"></script>
      <script>
    menuPropagation()
  </script>
  <script>
    $(document).ready(function() {
    
// handling login 
$(".loginbtn").click(function(){
  var email=$(".email").val().trim();
  var password=$(".password").val().trim();
 var hasError=false
 var rememberMe=false
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
    hasError =false
 }
//  check whether remember me is set
if ($("#rememberMe").is(":checked")) {
  rememberMe=true
} else {
  rememberMe=false
}

  // check if there is error
  if(!hasError){
       // send an ajax_request
       $.ajax({
      url:"loginController.php",
      method:"POST",
      data:{password:password,email:email,rememberMe:rememberMe},
      beforeSend:function(){
        $(".messagediv").html('<p class="text-primary"><i class="fa fa-spinner fa-spin text-primary"></i> Authenticating ...</p>')
      },
      success:function(response){
        var parsedResponse = JSON.parse(response);
        if (parsedResponse.status == 1) {
          $(".messagediv").html('<p class="text-success"><i class="fa fa-check text-success"></i> Login Successful. Redirecting ...</p>');
          $.notify('Login Successful: ' , {
            position: 'top left',
            autoHideDelay: 2000, 
            className: 'success' 
          });      
          setTimeout(function() {
            window.location.href = 'authorHome.php?author=' + parsedResponse.author_randid;
          }, 2000);
        }else if(parsedResponse.status==2){
          $(".messagediv").html('<p class="text-danger"><i class="fa fa-times text-danger"></i> Login Failed. Please Check Credentials </p>')
        $(".password").val("")
        $.notify('Please Check Credentials ' , {
            position: 'top left',
            autoHideDelay: 2000, 
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
            autoHideDelay: 5000, 
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
  



// handling sign in with google
$(".googlesigninbtn").click(()=>{
var googleUrl=$("body").data("googleurl")
 window.location.href=googleUrl;
})

    });
  </script>
</body>
</html>
