
<?php
session_start();
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
// Check if the content, title, category, and published status are received
if (isset($_POST['content'], $_POST['title'], $_POST['category_randid'], $_POST['article_randid'], $_POST['publishedstatus'])) {
    $content = $_POST['content'];
    $articleTitle = clean($_POST['title']);
    $category_randid = clean($_POST['category_randid']);
    $publishedstatus = clean($_POST['publishedstatus']);
    $author_randid = clean($_POST['author_randid']);
    $article_randid = clean($_POST['article_randid']);
    $old_cover = getArticleCover($conn, $article_randid);
    $articleImageDestPath = $old_cover; // Default to the old cover path
    $articleImageTempPath = "";
    
    // Check if the article image file is received in the FormData
    if (isset($_FILES['articleimagefile']) && $_FILES['articleimagefile']['error'] === UPLOAD_ERR_OK) {
        $articleImageFile = $_FILES['articleimagefile'];
        $articleImageTempPath = $articleImageFile['tmp_name'];
        $articleImageExt = pathinfo($articleImageFile['name'], PATHINFO_EXTENSION);
        $articleImageName = $article_randid . '.' . $articleImageExt;
        $articleImageDestPath = '../articles_cover/' . $articleImageName;

        // Delete the existing image
        if (file_exists($old_cover)) {
            unlink($old_cover);
        }

    }

    // Move the uploaded image to the destination folder
    move_uploaded_file($articleImageTempPath, $articleImageDestPath);
    // Update the article in the articles table
    $updateArticleQuery = 'UPDATE articles SET title = ?, content = ?, category_randid = ?, 
                           publishstatus = ?, article_cover = ?, modified_date = NOW()
                           WHERE article_randid = ?';
    $stmt = $conn->prepare($updateArticleQuery);
    $stmt->execute([$articleTitle, $content, $category_randid, $publishedstatus, $articleImageDestPath, $article_randid]);
 
            // get the article id and create a slug for it
            $article_id=getArticleId($conn,$article_randid);
            $slug=generateSlug($articleTitle,$article_id);
            $upstmt=$conn->prepare("update articles set slug=? where article_id =?");
            if($upstmt->execute([$slug,$article_id])){
                 echo 1;
            }else{
                echo -3;
            }
} else {
    // If the content, title, category, or published status is not received, send an error response
    echo 0;
}
?>