<?php 
// Initialize the session
session_start();
require_once '../resources/config.php';
error_reporting(0);
$conn= DatabaseConnection::getInstance();

// check if code is set....any account has been selected
$accessToken="";
if (isset($_GET['code'])) {
  $authCode = $_GET['code'];
  $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
    $_SESSION['access_token']=$accessToken;
} else{
  $authUrl = $client->createAuthUrl();
 header('Location: ' . $authUrl);
 exit; 
}


// handling the signup function and sign in
if (isset($_SESSION['action'])) {
    $action=clean($_SESSION['action']);
    if($action=="login"){
        $response = array();
if (!empty($accessToken)&& isset($_SESSION['access_token'])) {
  // Get the user's profile information.
  $client->setAccessToken($accessToken);
  $service = new Google_Service_Oauth2($client);
  $userInfo = $service->userinfo->get();
$randId = randomToken(15);
$email=$userInfo['email'];
$full_name=$userInfo['name'];
$unamechecker = "SELECT * FROM authors WHERE email = ? and  join_method =?";
$chk = $conn->prepare($unamechecker);
$chk->execute([$email,"google"]);
if ($chk->rowCount() > 0) { // checking if the email is already registered
$author_out=$chk->fetch(PDO::FETCH_ASSOC);
$author_randid=$author_out['author_randid'];
// user exists....tell the user to login
$_SESSION['author_randid'] = $author_randid;
$_SESSION['loggedin'] = true;
  $authToken1=randomToken(90);
  setcookie("AuthToken0", $author_randid, time() + (10 * 365 * 24 * 60 * 60), '/', '', true, true);
  setcookie("AuthToken1", $authToken1, time() + (10 * 365 * 24 * 60 * 60), '/', '', true, true);
    //inserting to the AuthorCookies Table
    $coo="insert into AuthorCookies (author_randid,AuthToken0,AuthToken1)values(?,?,?)";
    $coost=$conn->prepare($coo);
    $coost->execute([$author_randid,$author_randid,$authToken1]);
					// add user to logged in table
					$query = "INSERT INTO AuthorLogin (author_randid) VALUES (?)";
					$loginstmt = $conn->prepare($query);
					$loginstmt->execute([$author_randid]);
				// user is logged in take user to hoome
header("location:authorHome.php?author=" .$author_randid);
exit;

} else {
// user has not created an account
 header('Location: authorSignup.php');
 exit;
}
} else {
  // If the user is not logged in, redirect them to Google to authorize your app
  $authUrl = $client->createAuthUrl();
 header('Location: ' . $authUrl);
 exit;
}

        
        
        //end of logging in the user 
    }elseif($action="signup"){
// sign up
$response = array();
if (!empty($accessToken)&& isset($_SESSION['access_token'])) {
  // Get the user's profile information.
  // Check if it's a JWT (assuming JWTs have dots in them)
  $client->setAccessToken($accessToken);
  $service = new Google_Service_Oauth2($client);
  $userInfo = $service->userinfo->get();
//   insert data in the database
$ip = getIPAddress();
$randId = randomToken(15);
$email=$userInfo['email'];
$full_name=$userInfo['name'];
$unamechecker = "SELECT * FROM authors WHERE email = ? and  join_method =?";
$chk = $conn->prepare($unamechecker);
$chk->execute([$email,"google"]);
if ($chk->rowCount() > 0) { // checking if the email is already registered
$author_out=$chk->fetch(PDO::FETCH_ASSOC);
$author_randid=$author_out['author_randid'];
// user exists....tell the user to login
$_SESSION['author_randid'] = $author_randid;
$_SESSION['loggedin'] = true;
  $authToken1=randomToken(90);
  setcookie("AuthToken0", $author_randid, time() + (10 * 365 * 24 * 60 * 60), '/', '', true, true);
  setcookie("AuthToken1", $authToken1, time() + (10 * 365 * 24 * 60 * 60), '/', '', true, true);
    //inserting to the AuthorCookies Table
    $coo="insert into AuthorCookies (author_randid,AuthToken0,AuthToken1)values(?,?,?)";
    $coost=$conn->prepare($coo);
    $coost->execute([$author_randid,$author_randid,$authToken1]);
					// add user to logged in table
					$query = "INSERT INTO AuthorLogin (author_randid) VALUES (?)";
					$loginstmt = $conn->prepare($query);
					$loginstmt->execute([$author_randid]);
				// user is logged in take user to hoome
header("location:authorHome.php?author=" .$author_randid);
exit;

} else {
	$adduser = "INSERT INTO authors(full_name, email, active_status , author_randid, IP_address,join_method)
VALUES (?, ?, ?, ?, ?,?)";
	$stmt = $conn->prepare($adduser);
if ($stmt->execute([$full_name, $email,"yes", $randId, $ip,"google"])) {
	      //  get author_id and create slug
	      $author_id=getAuthorId($conn,$randId);
	      $author_slug=generateSlug($full_name,$author_id);
	      //update slug variable
	      $updater="update authors set slug=? where author_randid=?";
	      $upstmt=$conn->prepare($updater);
	      $upstmt->execute([$author_slug,$randId]);
	  
    	    $response['status'] = 1;
    		$response['author_randid'] = $randId;
    		$_SESSION['author_randid'] = $randId;
    		$_SESSION['loggedin'] = true;
                // set the user cookies
                $authToken1=randomToken(90);
  setcookie("AuthToken0", $author_randid, time() + (10 * 365 * 24 * 60 * 60), '/', '', true, true);
  setcookie("AuthToken1", $authToken1, time() + (10 * 365 * 24 * 60 * 60), '/', '', true, true);
    //inserting to the AuthorCookies Table
    $coo="insert into AuthorCookies (author_randid,AuthToken0,AuthToken1)values(?,?,?)";
    $coost=$conn->prepare($coo);
    $coost->execute([$author_randid,$author_randid,$authToken1]);
					// add user to logged in table
					$query = "INSERT INTO AuthorLogin (author_randid) VALUES (?)";
					$loginstmt = $conn->prepare($query);
					$loginstmt->execute([$author_randid]);
				// user is logged in take user to hoome
		header("location:authorHome.php?author=" . $_SESSION['author_randid']);
                exit;
				} else {
					$response['status'] = -1;
					$response['author_randid'] = 0000;
				}
		}
} else {
  // If the user is not logged in, redirect them to Google to authorize your app
  $authUrl = $client->createAuthUrl();
 header('Location: ' . $authUrl);
 exit;
}



    }//action is signup
}//end of session action

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
  <title><?php echo "Google Signup - " . $sitename; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <meta name="google-signin-client_id" content="406634251921-ala2u6h8eg7irj5frdvsrha9lf2quani.apps.googleusercontent.com">
  <link rel="stylesheet" href="../menu/menu.css">

</head>

<body class="custom-gray" data-googleurl=<?php echo $authUrl?>>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
      </div>

      <div class=" col-lg-5  ">

        <div class="login-form custom-gray">
         <!--sign up here-->
        </div>
        
        
        
      </div>
      <div class="col-md-3 ">
        <!-- categories come here-->
        <div class="categoriesdiv"></div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://accounts.google.com/gsi/client" async></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../resources/notify.min.js"></script>
   <script src="../menu/menu.js"></script>
    <script>
    menuPropagation()
  </script>
  <script>
    $(document).ready(function() {
     


// google sign Up
$(".googlesignupbtn").click(()=>{
    var googleUrl=$("body").data("googleurl")
 window.location.href=googleUrl
})


    });
  
</script>
</body>
</html>
