<?php
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
// Check if the content, title, category, and published status are received
if (isset($_POST['content'], $_POST['title'], $_POST['category_randid'], $_POST['publishedstatus'])) {
    $content = $_POST['content'];
    $articleTitle = ucwords(strtolower(clean($_POST['title'])));
    $category_randid = clean($_POST['category_randid']);
    $publishedstatus = clean($_POST['publishedstatus']);
    $author_randid = clean($_POST['author_randid']);
    $article_randid = randomToken(20);

    // Check if the article image file is received in the FormData
    if (isset($_FILES['articleimagefile']) && $_FILES['articleimagefile']['error'] === UPLOAD_ERR_OK) {
        $articleImageFile = $_FILES['articleimagefile'];
        $articleImageTempPath = $articleImageFile['tmp_name'];
        $articleImageExt = pathinfo($articleImageFile['name'], PATHINFO_EXTENSION);
        $articleImageName = $article_randid . '.' . $articleImageExt;
        $articleImageDestPath = '../articles_cover/' . $articleImageName;
            // Move the uploaded image to the destination folder
            if(move_uploaded_file($articleImageTempPath, $articleImageDestPath)){
            // Insert the article into the articles table
            $insertArticleQuery = 'INSERT INTO articles (title, content, category_randid, publishstatus, article_randid, article_cover) VALUES (?, ?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($insertArticleQuery);
            $stmt->execute([$articleTitle, $content, $category_randid, $publishedstatus, $article_randid, $articleImageDestPath]);
            // Insert into the article_author table
            $insertArticleAuthorQuery = 'INSERT INTO article_author (article_randid, author_randid) VALUES (?, ?)';
            $stmt = $conn->prepare($insertArticleAuthorQuery);
            $stmt->execute([$article_randid, $author_randid]);
       
            // get the article id and create a slug for it
            $article_id=getArticleId($conn,$article_randid);
            $articleSlug=generateSlug($articleTitle,$article_id);
            $upstmt=$conn->prepare("update articles set slug=? where article_id =?");
            if($upstmt->execute([$articleSlug,$article_id])){
                 echo 1;
            }else{
                echo -3;
            }
        }else{
            echo -1; //image not uploaded
        }
    } else {
        // If the article image file is not received or there is an error, set the image name to NULL
        echo -2;
    }
} else {
    // If the content, title, category, or published status is not received, send an error response
    echo 0;
}


?>
