<?php 
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
if(isset($_POST["author"]) && !empty($_POST['author'])&& $_SERVER["REQUEST_METHOD"]=="POST"){
// get the email of the user
 $authorrandid = clean($_POST['author']);
 $checkQuery = "SELECT active_status  from authors inner join email_verification_tokens on authors.author_randid=email_verification_tokens.author_randid
 where email_verification_tokens.author_randid=?";
$checkStmt = $conn->prepare($checkQuery);
$checkStmt->execute([$authorrandid]);
if ($checkStmt->rowCount() > 0) {
    $result=$checkStmt->fetch(PDO::FETCH_ASSOC);
    $status=$result['active_status'];
    if($status=='yes'){
        echo 1;
    }

}else{
     echo " ".$authorrandid;
    exit;
}
}else{
echo 3 ;
    exit;
}