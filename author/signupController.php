<?php
	session_start();
	require_once '../resources/config.php';
	$conn= DatabaseConnection::getInstance();
if (isset($_POST['password']) && isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['password']) && $_SERVER["REQUEST_METHOD"] == "POST") {
		$full_name = clean($_POST['full_name']);
		$email = clean($_POST['email']);
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$rawpassword = clean($_POST['password']);
		$password = password_hash($rawpassword, PASSWORD_DEFAULT); 
		$ip = getIPAddress();
		$randId = randomToken(15); // generate a random token of len 15 chars
		$emailtoken=randomToken(40);
		$response = array();
		$unamechecker = "SELECT * FROM authors WHERE email = ?";
		$chk = $conn->prepare($unamechecker);
		$chk->execute([$email]);
		if ($chk->rowCount() > 0) { // checking if the email is already registered
			$response['status'] = 2;
			$response['author_randid'] = 0000;
		} else {
				$adduser = "INSERT INTO authors(full_name, email, password, author_randid, IP_address)
	       VALUES (?, ?, ?, ?, ?)";
				$stmt = $conn->prepare($adduser);
			if ($stmt->execute([$full_name, $email, $password, $randId, $ip])) {
				      	// send verification email
        		    $stat=sendEmail($sitename,$emailtoken,$email);
        		    if($stat==1){
        		        $insquery="insert into email_verification_tokens (author_randid ,email_token) values(?,?)";
        		        $sstt=$conn->prepare($insquery);
        		        $sstt->execute([$randId,$emailtoken]);
        		      //  get author_id and create slug
        		      $author_id=getAuthorId($conn,$randId);
        		      $author_slug=generateSlug($full_name,$author_id);
        		      //update slug variable
        		      $updater="update authors set slug=? where author_randid=?";
        		      $upstmt=$conn->prepare($updater);
        		      $upstmt->execute([$author_slug,$randId]);
        		      
        		    }
        		    $response['status'] = 1;
					$response['author_randid'] = $randId;
					$_SESSION['author_randid'] = $randId;
					$_SESSION['loggedin'] = true;

					// add user to logged in table
					$query = "INSERT INTO AuthorLogin (author_randid) VALUES (?)";
					$loginstmt = $conn->prepare($query);
					$loginstmt->execute([$author_randid]);
				} else {
					$response['status'] = -1;
					$response['author_randid'] = 0000;
				}
		  
		}
		echo json_encode($response);
	}
	
// 	resending verification email
if (isset($_POST['author']) && isset($_POST['email'])){
    $randId=clean($_POST['author']);
    $email=clean($_POST['email']);
    $emailtoken=randomToken(40);
    $stat=sendEmail($sitename,$emailtoken,$email);
    
    if($stat==1){
        // Check if a record exists with the given author_randid
$checkQuery = "SELECT author_randid FROM email_verification_tokens WHERE author_randid = ?";
$checkStmt = $conn->prepare($checkQuery);
$checkStmt->execute([$randId]);

if ($checkStmt->rowCount() > 0) {
    // Update the email_token
    $updateQuery = "UPDATE email_verification_tokens SET email_token = ? WHERE author_randid = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->execute([$emailtoken,$randId]);
} else {
    // Insert a new record
    $insertQuery = "INSERT INTO email_verification_tokens (author_randid, email_token) VALUES (?,?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->execute([$randId,$emailtoken]);
}

    }
    echo $stat ;
}

// handling login with gmail
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  // now you can use this profile info to create account in your website and make user logged in.
} else {
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}



function sendEmail($sitename,$randId,$email){
$msg = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>' . $sitename . ' Email Verification</title>
     <link rel="icon" type="image/x-icon" href="https://www.sociolme.com/logos/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
           background-color: #fff;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .headingtext {
            color: #d24d33;
            font-size: 24px;
            text-align: center;
            margin-top: 0;
        }
        .logo {
            display: block;
            margin: 0 auto;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #d24d33;
            color: #fff;
            text-align: center;
            line-height: 60px;
            font-size: 30px;
        }
        .message {
            margin-top: 30px;
            font-size: 18px;
            text-align: center;
            color: #000;
        }
        .btn-container {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
<img src="cid:sender-icon" alt="Sender Icon" style="width: 30px; height: 30px; border-radius: 50%;">

    <div class="container">
            <div style="text-align: center;">
          <p  class="headingtext">' . $sitename . ' Email Verification </p>
        </div>
        
        <p class="logo">
        <img src="cid:logo" style="width:60px;height:60px; border-radius:50%;">
        </p>
        <p class="message">
            Thank you for choosing to join our blog site. Please click the button below to verify your ' . $sitename . ' author  account.
        </p>
        <div class="btn-container">
           <a href="https://www.sociolme.com/author/accountActivationPage.php?token=' . $randId . '" style="background-color:#f2f2f2; text-decoration:none;">
           
       <button style="width:30%; background-color: #ffc107; color:#000; border-radius:10px; font-size:14px; height:40px; border: 2px solid #ffc107;">
              Verify Account
            </button>
        </a>
        
        </div>
         <p class="message">We appreciate your dedication and look forward to your contributions on our blog site. Welcome aboard!
            If you did not register with us, please ignore this message.
            </p>
             <p class="message">
            Best regards,<br><br>
            The ' . $sitename . ' Team
        </p>
    </div>
</body>
</html>';



 
$subject = $sitename . ' Account Verification';

  if(smtpmailer($email, $subject, $msg)){
      return 1;
  }else{
      return -1;
  }

}
?>
