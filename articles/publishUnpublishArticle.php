<?php
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
// Check if the content, title, category, and published status are received
if (isset($_POST['article_randid'], $_POST['action'])) {
    $article_randid = clean($_POST['article_randid']);
    $action =clean($_POST['action']);
    if ($action=="publish"){
        $status="true";
    }else if ($action=="unpublish"){
        $status="false";
    }
    
 $updatestatusquery = 'update articles set  publishstatus = ? where  article_randid = ? ';
$stmt = $conn->prepare($updatestatusquery);
if( $stmt->execute([$status,$article_randid])){
           echo 1;
        } else {
            // Invalid file format
            echo -1;
        }
   
} else {
    echo 0;
}
?>
