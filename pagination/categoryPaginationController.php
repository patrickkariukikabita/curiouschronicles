<?php
if(isset($_GET['slug'])&& isset($_GET['page'])){
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
$slug=clean($_GET['slug']);
$pageNumber = clean($_GET['page']);
$cat_randid=getCategoryRandidFromSlug($conn, $slug);
$itemsPerPage = 10;
$totalItems=0;
$data = '';
    $basePath = '';
    if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
        $basePath = './articles_cover/';
        $pathprefix="./";
    } else {
        $basePath = '../articles_cover/';
        $pathprefix="../";
    }
$offset = ($pageNumber - 1) * $itemsPerPage;
    // query data from the database using author randid
    // Fetch the newest 10 articles with author names and category descriptions
    $stmt = $conn->prepare("
    SELECT a.article_id, a.title, a.content, a.date, a.article_randid, a.article_cover,a.slug, au.full_name
     AS author_name,au.slug as authorslug, au.author_randid as authorrand, c.category_id,c.slug as catslug, c.category_name, c.category_randid,
     c.description AS category_description
    FROM articles AS a
    INNER JOIN article_author AS aa ON a.article_randid = aa.article_randid
    INNER JOIN authors AS au ON aa.author_randid = au.author_randid
    INNER JOIN categories AS c ON a.category_randid = c.category_randid where c.slug=? and a.publishstatus=?
    ORDER BY a.date DESC LIMIT $offset,$itemsPerPage
");
$stmt->execute([$slug,"true"]);
if($stmt->rowCount()>0){
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Generate HTML for articles

foreach ($articles as $article) {
    $articleId = $article['article_id'];
    $article_randid = $article['article_randid'];
    $title = $article['title'];
    $encodedTitle=$article['slug'];
    $authorslug = $article['authorslug'];
    $catslug = $article['catslug'];
    $content = $article['content'];
    $date = $article['date'];
    $authorName = $article['author_name'];
    $catcategoryName = $article['category_name'];
    $category_randid=$article['category_randid'];
    $category_id=$article['category_id'];
    $categoryDescription = $article['category_description'];
    $cover=$article['article_cover'];
    $authorrand=$article['authorrand'];
    $strippedText = strip_tags($content); // Remove HTML tags
    $ellipsizedText = substr($strippedText, 0, 200); // Ellipsize text if needed
    $articleData = $ellipsizedText . ' ...';
    $placeholder=$basePath .'placeholder.webp';
    $data .= '
    <div class=" colcard card  mb-1 " onmouseover="this.querySelector(\'.title\').style.color=\'#1845cd\';
    this.querySelector(\'.article_image\').style.filter=\'grayscale(10%)\';"
    onmouseout=" this.querySelector(\'.article_image\').style.filter=\'\'; 
    this.querySelector(\'.title\').style.color=\'\';">
            <a href="'.$pathprefix.'article/'.$encodedTitle.'" style="width: 100%; ">
            <img class="card-img-top lazy article_image mt-3" style="width:90%;height=302px; margin-left:5%;" 
            data-src="' . $cover . '" src="' . $placeholder . '" alt=" Cover Image"  />
            </a>
            <div class="card-body">
                <div class=" text-muted small my-2">
                <a href="'.$pathprefix.'category/'.$catslug.'" class="text-primary px-2"
                style="text-decoration:none; font-size:12px;" title="Posts In '.$catcategoryName .'">
                <i  class="fa fa-folder"> </i>   ' . $catcategoryName . '
                 </a>
                <a href="'.$pathprefix.'author/'.$authorslug.'" class="px-2"
                style="color: #d24d33;text-decoration:none; font-size:12px;" title="Posts By '.$authorName .'">
                <i  class="fa fa-user"> </i>    ' . $authorName . '
                 </a>              
                </div>
                <a href="'.$pathprefix.'article/'.$encodedTitle.'" class="h5 headingFont title fw-bold">
               '. $title . '
                    </a>
                <p class="card-text bodyFont mt-2">'. $articleData.'</p>
            </div>
        </div>
            ';

     
}//end of foreach
// Get total number of items

// Get total number of items
$stmt2 = $conn->prepare("SELECT COUNT(*) FROM articles inner join categories on articles.category_randid=
categories.category_randid WHERE categories.category_randid = ? and articles.publishstatus=?");
$stmt2->execute([$cat_randid,"true"]);
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