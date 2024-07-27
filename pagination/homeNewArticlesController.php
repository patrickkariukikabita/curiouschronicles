<?php
if( isset($_GET['page'])){
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
$pageNumber = clean($_GET['page']);
$itemsPerPage = 12;
$totalItems=0;
$offset = ($pageNumber - 1) * $itemsPerPage;
$data = '';

$stmt = $conn->prepare("
SELECT a.title, a.content,a.date, a.article_randid, a.article_cover,a.slug, au.slug as authorslug,c.slug as catslug,
au.full_name AS author_name,au.author_randid as authorrand, c.category_name,c.category_randid, c.description 
AS category_description
FROM articles AS a
INNER JOIN article_author AS aa ON a.article_randid = aa.article_randid
INNER JOIN authors AS au ON aa.author_randid = au.author_randid
INNER JOIN categories AS c ON a.category_randid = c.category_randid where a.publishstatus=?
ORDER BY a.date DESC  LIMIT $offset,$itemsPerPage
");
$articlesArray=[];
$stmt->execute(["true"]);
if($stmt->rowCount()>0){
$articlesrst = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Generate HTML for articles
foreach ($articlesrst as $articleRow) {
  $randid =$articleRow['article_randid'];
  $title = $articleRow['title'];
  $slug = $articleRow['slug'];
  $authorslug = $articleRow['authorslug'];
  $catslug = $articleRow['catslug'];
  $cover = $articleRow['article_cover'];
  $categoryName =$articleRow['category_name'];
  $categoryDescription =$articleRow['category_description'];
  $date = $articleRow['date'];
  $date = date('jS F Y', strtotime($date));
  $authorrand =  $articleRow['authorrand'];
  $authorName = $articleRow['author_name'];
  $category_randid = $articleRow['category_randid'];
  $basePath = '';
  if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
    $basePath = './articles_cover/';
    $pathprefix="./";
} else {
    $basePath = '../articles_cover/';
    $pathprefix="../";
}

  // Extract the image name from the cover path
  $imageName = basename($cover);
  $placeholder=$basePath."placeholder.webp";
  // Construct the relative path to the image using the image name and the determined base path
  $relativecoverpath = $basePath . $imageName;
  $strippedText = strip_tags($articleRow['content']); // Remove HTML tags
  $ellipsizedText = substr($strippedText, 0, 200); // Ellipsize text if needed
  $articleData = $ellipsizedText . ' ...';

  $data .= '
        <div class="card mb-2" onmouseover="this.querySelector(\'.title\').style.color=\'#1845cd\';
        this.querySelector(\'.article_image\').style.filter=\'grayscale(10%)\';"
        onmouseout=" this.querySelector(\'.article_image\').style.filter=\'\'; this.querySelector(\'.title\').style.color=\'\';">
                <a href="'.$pathprefix.'article/'.$slug.'" style="width: 100%; ">
                <img class="card-img-top lazy article_image mt-3" style="width:90%;height=302px; margin-left:5%;" 
                data-src="' . $relativecoverpath . '" src="' . $placeholder . '" alt=" Cover Image"  />
                </a>
                <div class="card-body">
                    <div class=" text-muted small my-2">
                    <a href="'.$pathprefix.'category/'.$catslug.'" class="text-primary px-2 me-1 border rounded-pill  border-secondary"
                    style="text-decoration:none; font-size:12px;" title="Posts In '.$categoryName .'">
                    <i  class="fa fa-folder"> </i>   ' . $categoryName . '
                     </a>
                    <a href="'.$pathprefix.'author/'.$authorslug.'" class="px-2  border rounded-pill  border-secondary"
                    style="color: #d24d33;text-decoration:none; font-size:12px;" title="Posts By '.$authorName .'">
                    <i  class="fa fa-user"> </i>    ' . $authorName . '
                     </a>              
                    </div>
                    <a href="'.$pathprefix.'article/'.$slug.'" class=" h5 headingFont title fw-bold">
                   '. $title . '
                        </a>
                    <p class="card-text bodyFont mt-2">'. $articleData.'</p>
                </div>
            </div>
                ';

}
// Get total number of items
$stmt2 = $conn->prepare("SELECT COUNT(*) FROM articles where publishstatus=?");
$stmt2->execute(["true"]);
$totalItems = $stmt2->fetchColumn();

}
else{
    // missing article
   $data = '
    <div class="  card  mb-1 ">
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


