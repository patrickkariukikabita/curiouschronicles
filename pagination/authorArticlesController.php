<?php
if(isset($_GET['slug'])&& isset($_GET['page'])){
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
$url=clean($_GET['slug']);
$pageNumber = clean($_GET['page']);
$itemsPerPage = 1;
$totalItems=0;
$data = '';
$offset = ($pageNumber - 1) * $itemsPerPage;
// Extract the ID and name
$parts = explode('-', trim($url, '/'));
$author_id = intval($parts[0]);
$author_randid;
    // query data from the database using author randid
    // Fetch the newest 10 articles with author names and category descriptions
    $stmt = $conn->prepare("
    SELECT a.*, au.full_name AS author_name,au.slug as authorslug,au.author_randid as authorrand, c.category_id,c.category_name, c.category_randid,c.slug as catslug,
     c.description AS category_description
    FROM articles AS a
    INNER JOIN article_author AS aa ON a.article_randid = aa.article_randid
    INNER JOIN authors AS au ON aa.author_randid = au.author_randid
    INNER JOIN categories AS c ON a.category_randid = c.category_randid where au.author_id=? and au.slug=? and a.publishstatus=?
    ORDER BY a.date DESC LIMIT  $offset,$itemsPerPage
");
$stmt->execute([$author_id,$url,"true"]);
if($stmt->rowCount()>0){
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Generate HTML for articles
foreach ($articles as $article) {
    $articleId = $article['article_id'];
    $title = $article['title'];
    $encodedTitle=$article['slug'];
    $authorslug = $article['authorslug'];
    $catslug = $article['catslug'];
    $content = $article['content'];
    $date = $article['date'];
    $author_name = $article['author_name'];
    $catcategoryName = $article['category_name'];
    $catcategory_randid=$article['category_randid'];
    $category_id=$article['category_id'];
    $categoryDescription = $article['category_description'];
    $article_randid = $article['article_randid'];
    $cover=$article['article_cover'];
    $authorrand=$article['authorrand'];
    $author_randid=$authorrand;
    $strippedText = strip_tags($content); // Remove HTML tags
  $ellipsizedText = substr($strippedText, 0, 200); // Ellipsize text if needed
  $authorArticleData = $ellipsizedText . ' ...';

    $basePath = '';
    if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
        $basePath = './articles_cover/';
        $pathprefix="./";
    } else {
        $basePath = '../articles_cover/';
        $pathprefix="../";
    }
    $placeholder=$basePath."placeholder.webp";
$data .= '
    <div class=" colcard card  mb-1 " onmouseover="this.querySelector(\'.title\').style.color=\'#1845cd\';
    this.querySelector(\'.article_image\').style.filter=\'grayscale(10%)\';"
    onmouseout=" this.querySelector(\'.article_image\').style.filter=\'\'; 
    this.querySelector(\'.title\').style.color=\'\';">
            <a href="'.$pathprefix.'article/'.$encodedTitle.'"  style="width: 100%; ">
            <img class="card-img-top lazy article_image mt-3" style="width:90%;height=302px; margin-left:5%;" 
            data-src="' . $cover . '" src="' . $placeholder . '" alt=" Cover Image"  />
            </a>
            <div class="card-body">
                <div class=" text-muted small my-2">
                <a href="'.$pathprefix.'category/'.$catslug.'" class="text-primary px-2 me-1 border rounded-pill  border-secondary"
                style="text-decoration:none; font-size:12px;" title="Posts In '.$catcategoryName .'">
                <i  class="fa fa-folder"> </i>   ' . $catcategoryName . '
                 </a>
                <a href="'.$pathprefix.'author/'.$authorslug.'" class="px-2 border rounded-pill  border-secondary"
                style="color: #d24d33;text-decoration:none; font-size:12px;" title="Posts By '.$author_name .'">
                <i  class="fa fa-user"> </i>    ' . $author_name . '
                 </a>              
                </div>
                <a href="'.$pathprefix.'article/'.$encodedTitle.'"  class=" h5 headingFont title fw-bold">
               '. $title . '
                    </a>
                <p class="card-text bodyFont mt-2">'. $authorArticleData.'</p>
            </div>
        </div>
            ';
}

// Get total number of items
$stmt2 = $conn->prepare("SELECT COUNT(*) FROM articles inner join article_author on  articles.article_randid=article_author.article_randid WHERE article_author.author_randid = ? and articles.publishstatus=?");
$stmt2->execute([$author_randid,"true"]);
$totalItems = $stmt2->fetchColumn();


}
else{
    // missing article
   $data = '
    <div class=" colcard card  mb-1 ">
    <div class="card-body">
    <div class="  my-2 card-text">
         <p class="  mt-2 text-danger  lead fw-bold h3">You have reached to the end of the list </p>                   
    </div>
    </div>
    </div>
            ';
}

echo json_encode([
    'data' => $data,
    'total' => $totalItems,
    'itemsPerPage' => $itemsPerPage
]);
}else{
    exit;
}
?>