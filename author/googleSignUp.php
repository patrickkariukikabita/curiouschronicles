<?php
session_start();
require_once '../resources/config.php'; 
$conn= DatabaseConnection::getInstance();
// Check if the user is already logged in.
if (isset($_SESSION['access_token']) &&!empty($_SESSION['access_token'])) {
  // Get the user's profile information.
  $client->setAccessToken($_SESSION['access_token']);
  $service = new Google_Service_Oauth2($client);
  $userInfo = $service->userinfo->get();
//   insert data in the database
$ip = getIPAddress();
$randId = randomToken(15);
$email=$userInfo['email'];
$full_name=$userInfo['name'];
$response = array();
$unamechecker = "SELECT * FROM authors WHERE email = ?";
$chk = $conn->prepare($unamechecker);
$chk->execute([$email]);
if ($chk->rowCount() > 0) { // checking if the email is already registered
$response['status'] = 2;
$response['author_randid'] = 0000;
} else {
	$adduser = "INSERT INTO authors(full_name, email, active_status , author_randid, IP_address)
VALUES (?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($adduser);
if ($stmt->execute([$full_name, $email,"yes", $randId, $ip])) {
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
				} else {
					$response['status'] = -1;
					$response['author_randid'] = 0000;
				}
		}
// 		still in AuthorSignup.php
		echo json_encode($response);
} else {
    
  // If the user is not logged in, redirect them to Google to authorize your app
  $authUrl = $client->createAuthUrl();
 header('Location: ' . $authUrl);
 exit;
}

// handling the signup function
if (isset($_GET['code'])) {
  $authCode = $_GET['code'];
  $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
  // Store the access token in the session.
  $_SESSION['loggedin'] = true;
    $_SESSION['access_token']=$accessToken;
  // Redirect the user back to your app.
//   header('Location: index.php');
}

