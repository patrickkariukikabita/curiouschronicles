<?php
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
session_start();

$response = array();

if (isset($_POST['email'], $_POST['password'],$_POST['rememberMe'])) {
  $email = clean($_POST['email']);
  $password = clean($_POST['password']); 
  $rememberMe=clean($_POST['rememberMe']);
  $query = "SELECT author_randid,password FROM authors WHERE email = ? ";
  $stmt = $conn->prepare($query);
  $stmt->execute([$email]);
    $output = $stmt->fetch(PDO::FETCH_ASSOC);
    $author_randid = $output['author_randid'];
    $Storedpassword=$output['password'];
    if (password_verify($password, $Storedpassword)) {
    $_SESSION['author_randid'] = $author_randid;
    $_SESSION['loggedin']=true;
// successful login
    $response['status'] = 1;
    $response['author_randid'] =  $author_randid;

    // insert into AuthorLogin table
    $query="insert into AuthorLogin (author_randid) values(?)";
    $loginstmt=$conn->prepare($query);
    $loginstmt->execute([$author_randid]);

     //check if the uer has set remember me option
 if ($rememberMe==true) {
  $authToken1=randomToken(90);
  setcookie("AuthToken0", $author_randid, time() + (10 * 365 * 24 * 60 * 60), '/', '', true, true);
  setcookie("AuthToken1", $authToken1, time() + (10 * 365 * 24 * 60 * 60), '/', '', true, true);
    //inserting to the AuthorCookies Table
    $coo="insert into AuthorCookies (author_randid,AuthToken0,AuthToken1)values(?,?,?)";
    $coost=$conn->prepare($coo);
    $coost->execute([$author_randid,$author_randid,$authToken1]);
    }

  } else {//incorrect cred
    $response['status'] = 2;
    $response['author_randid'] = 0000;
  }

echo json_encode($response);
}
?>
