<?php
$sitename = 'Sociolme';
$founderName="Patrick Kariuki";
$searchLimit=6;

error_reporting(E_ALL);
ini_set('display_errors', 1);

    // Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer;
require __DIR__.'/PHPMailer/src/Exception.php';
require __DIR__. '/PHPMailer/src/PHPMailer.php';
require __DIR__.'/PHPMailer/src/SMTP.php';


// Handling email
define('GUSER', 'noreply@sociolme.com');
define('GPWD', '8A2PYwfQW7WQejN');
define('HOST', 'mail.sociolme.com');
define('FROM', 'noreply@sociolme.com');
define('FROMNAME', $sitename);
define('PORT',587);

// handling sign in with google
// Google API configuration
define('GOOGLE_CLIENT_ID', '406634251921-ala2u6h8eg7irj5frdvsrha9lf2quani.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_REDIRECT_URL', 'https://www.sociolme.com/author/authorGoogleWaiting.php');

// Include Google API client library
require_once 'google-api-php-client/vendor/autoload.php';

// create Client Request to access Google API

$client = new Google_Client();
$client->setApplicationName('sociolme.com');
$client->setClientId(GOOGLE_CLIENT_ID);
$client->setClientSecret(GOOGLE_CLIENT_SECRET);
$client->setRedirectUri(GOOGLE_REDIRECT_URL);
$client->addScope("email");
$client->addScope("profile");



class DatabaseConnection {
    private static $instance = null;
    private static $connection = null;

    private function __construct() {
        // Create a new PDO instance
       // Create a new PDO instance
       $servername = "localhost:3306";
       $username = "root";
       $password = "";
       $dbname = "curiouschronicles";
        try {
            // Create a new PDO instance if a connection doesn't exist or connection is lost
            if (self::$connection === null || !$this->isConnectionActive()) {
                self::$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // Disable strict mode
                self::$connection->exec("SET sql_mode = ''");
                // Set PDO error mode to exception
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function isConnectionActive() {
        // Check if the connection is active
        return self::$connection !== null && self::$connection->getAttribute(PDO::ATTR_CONNECTION_STATUS) === "Connection successful";
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
            self::$instance->retryConnection();
        }
        return self::$connection;
    }

    private function retryConnection() {
        $retryCount = 0;
        $maxRetries = 3;
        while (self::$connection === null && $retryCount < $maxRetries) {
            sleep(1); // Wait for 1 second before retrying
            self::$instance = new self();
            $retryCount++;
        }

        if (self::$connection === null) {
            // Failed to establish a connection after maximum retries
            die("Failed to connect to the database");
        }
    }
}




function smtpmailer($to, $subject, $body) { 
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only 0=no debub errors
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->SMTPAutoTLS = false;
    $mail->Host =HOST ;
    $mail->Port =PORT;
    $mail->Username = GUSER;  
    $mail->Password = GPWD;           
    $mail->SetFrom(FROM,FROMNAME);
    $mail->Subject = $subject;
    $mail->AddEmbeddedImage('../logos/best_sociolme .png', 'logo');
    $mail->AddEmbeddedImage('../logos/best_sociolme .png', 'sender-icon', 'sender-icon.png');
    $mail->Body = $body;
    $mail->isHTML(true);
    $mail->AddAddress($to);
    if($mail->Send()){
        return true;
    }else{
        return false;
    }
    
  }

//MAKING A FUNCTION TO CLEAN THE USER INPUT
function clean($data){
  $data = trim($data);
  $data = implode("", explode("\\", $data)); //remove all slashes
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function getAuthorName($conn,$author_randid){
  $query="select full_name from authors where author_randid=?";
  $stmt=$conn->prepare($query);
  $stmt->execute([$author_randid]);
  $result=$stmt->fetch(PDO::FETCH_ASSOC);
  return $result['full_name'];
}
function getAuthorNameFromId($conn,$author_id){
  $query="select full_name from authors where author_id=?";
  $stmt=$conn->prepare($query);
  $stmt->execute([$author_id]);
  $result=$stmt->fetch(PDO::FETCH_ASSOC);
  return $result['full_name'];
}

function getAuthorId($conn,$author_randid){
  $query="select author_id from authors where author_randid=?";
  $stmt=$conn->prepare($query);
  $stmt->execute([$author_randid]);
  $result=$stmt->fetch(PDO::FETCH_ASSOC);
  return $result['author_id'];
}


function getArticleCover($conn,$article_randid){
  $query="select article_cover from articles where article_randid=?";
  $stmt=$conn->prepare($query);
  $stmt->execute([$article_randid]);
  $result=$stmt->fetch(PDO::FETCH_ASSOC);
  return $result['article_cover'];
}
function getIPAddress(){
  //whether ip is from the share internet  
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  //whether ip is from the remote address  
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
function randomToken($length){
  $key = '';
  $keys = array_merge(range(0, 9), range('a', 'z'));
  $keys = array_merge($keys, range("A", "Z"));

  for ($i = 0; $i < $length; $i++) {
    $key .= $keys[array_rand($keys)];
  }

  return $key;
}



// method to fetch random article and create a link
function randomArticle($conn, $articleId){
  $basePath = '';
  if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
      $basePath = './articles_cover/';
      $pathprefix="./";
  } else {
      $basePath = '../articles_cover/';
      $pathprefix="../";
  }
  $placeholder=$basePath."placeholder.webp";
  $sql = "SELECT article_randid,title,slug,article_cover FROM articles where article_id <> ? ORDER BY RAND() LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$articleId]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $randid = $result['article_randid'];
  $title = $result['title'];
   $slug = $result['slug'];
  $coverpath = $result['article_cover'];
  $html = "<br> <p class='mt-1 mx-3 text-orange headingFont '>You May Also Like: </p>";
  $html .= "<a href=$pathprefix"."article/"."$slug class='  articleFont  titlea' >";
  $html .= "<div class='border rounded border-secondary mx-2 p-3 my-2' >";
  $html .= "<div class='img-container mx-0 my-0' style='width: 100%; height: 80%;'>";
  $html .= "<img data-src='$coverpath' style='width: 100%; height: 200px;' class='img-fluid article-image lazy' src=$placeholder 
                    onmouseover='this.style.filter=\"grayscale(10%)\"; this.parentNode.nextElementSibling.style.color=\"#1845cd\"' 
                    onmouseout='this.style.filter=\"\"; this.parentNode.nextElementSibling.style.color=\"\"'>";
  $html .= "</div>";
  $html .= "<div style='word-break:break-word; ' class='my-2' onmouseover='this.style.color=\"#1845cd\"'
            onmouseout='this.style.color=\"\"'>$title'</div>";
  $html .= "</div>";
  $html .= "</a>";
  return $html;
}

function getArticleViews($conn, $randid){
  // Check if the article already exists in the article_views table
  $query = "SELECT * FROM article_views WHERE article_randid = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$randid]);
  if ($stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $views = $result['views'];
    return $views;
  } else {
    return 0;
  }

}

function insertRecommendedArticle($content,$randomContent,$paragraphIndex){
  $paragraphs = explode("</p>", $content);
  $modifiedContent = implode("</p>", array_slice($paragraphs, 0, $paragraphIndex))
      .$randomContent
      . implode("</p>", array_slice($paragraphs, $paragraphIndex));
return $modifiedContent;
}
function getSuggestedArticles($conn, $limit){
  $articlesArray = [];
  // Get random articles from the selected author and category
  $articleQuery = "SELECT a.*, 
  au.full_name AS author_name, au.author_randid AS authorrand, c.category_name, c.category_randid,c.slug as catslug,a.slug,au.slug as authorslug,
  c.description AS category_description FROM articles AS a
  INNER JOIN article_author AS aa ON a.article_randid = aa.article_randid
  INNER JOIN authors AS au ON aa.author_randid = au.author_randid
  INNER JOIN categories AS c ON a.category_randid = c.category_randid
  INNER JOIN article_views AS av ON a.article_randid = av.article_randid
  where a.publishstatus=?
  ORDER BY av.views desc LIMIT " . intval($limit);

  $articleStmt = $conn->prepare($articleQuery);
  $articleStmt->execute(["true"]);
  $articleResult = $articleStmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($articleResult as $articleRow) {
    $articleData = [];
    $articleData[] = $articleRow['article_randid'];
    $articleData[] = $articleRow['title'];
    $articleData[] = $articleRow['article_cover'];
    $articleData[] = ucwords($articleRow['category_name']);
    $articleData[] = $articleRow['category_description'];
    $articleData[] = $articleRow['date'];
    $articleData[] = $articleRow['authorrand'];
    $articleData[] = ucwords($articleRow['author_name']);
    $articleData[] = $articleRow['category_randid'];
    $strippedText = strip_tags($articleRow['content']); // Remove HTML tags
    $ellipsizedText = substr($strippedText, 0, 200); // Ellipsize text if needed
    $articleData[] = $ellipsizedText . ' ...';
    $articleData[] = $articleRow['slug'];
    $articleData[] = $articleRow['authorslug'];
    $articleData[] = $articleRow['catslug'];
    $articlesArray[] = $articleData;
    
  }

  // Return the random article ids
  return $articlesArray;
}



// getting a featured article
function getFeaturedArticle($conn){
  // Get random articles from the selected  category with most views
  $articleQuery = " SELECT a.title, a.date, a.article_randid, a.article_cover,a.content, a.slug,au.slug as authorslug,c.slug as catslug,
      au.full_name AS author_name,au.author_randid as authorrand, c.category_name,c.category_randid,
       c.description  AS category_description FROM articles AS a
      INNER JOIN article_author AS aa ON a.article_randid = aa.article_randid
          INNER JOIN authors AS au ON aa.author_randid = au.author_randid
          INNER JOIN categories AS c ON a.category_randid = c.category_randid
          WHERE a.publishstatus = ?
        ORDER by rand()  limit 1";
  $articleStmt = $conn->prepare($articleQuery);
  $articleStmt->execute(["true"]);
  if ($articleStmt->rowCount() > 0) {
    $articleRow = $articleStmt->fetch(PDO::FETCH_ASSOC);
    $articleData[] = $articleRow['article_randid'];
    $articleData[] = $articleRow['title'];
    $articleData[] = $articleRow['article_cover'];
    $articleData[] = ucwords($articleRow['category_name']);
    $articleData[] = $articleRow['category_description'];
    $articleData[] = $articleRow['date'];
    $articleData[] = $articleRow['authorrand'];
    $articleData[] = ucwords($articleRow['author_name']);
    $articleData[] = $articleRow['category_randid'];
    $strippedText = strip_tags($articleRow['content']); // Remove HTML tags
    $ellipsizedText = substr($strippedText, 0, 200); // Ellipsize text if needed
    $articleData[] = $ellipsizedText . ' ...';
      $articleData[] = $articleRow['slug'];
     $articleData[] = $articleRow['authorslug'];
     $articleData[] = $articleRow['catslug'];
    // Return the random article ids
    return $articleData;
  }
}

// getting popular categories
function getMostViewedCategories($conn, $limit = 5){
  $categoriesArray = [];
  // Query to get the most viewed categories
  $query = "SELECT c.category_name,c.slug,c.category_randid,c.description,SUM(av.views) AS total_views
            FROM categories AS c
            INNER JOIN articles AS a ON c.category_randid = a.category_randid
            INNER JOIN article_views AS av ON a.article_randid = av.article_randid
            GROUP BY c.category_name
            ORDER BY total_views DESC
            LIMIT " . intval($limit);
  $stmt = $conn->prepare($query);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $categoryData = [];
    $categoryData []= $row['category_name'];
    $categoryData[]=$row['total_views'];
    $categoryData[]=$row['category_randid'];
    $categoryData[]=$row['description'];
    $categoryData[]=$row['slug'];
    $categoriesArray[] = $categoryData;
  }

  return $categoriesArray;
}

// getting popular categories
function getMostViewedAuthors($conn, $limit = 5){
  $authorsArray = [];
  // Query to get the most viewed categories
  $query = "SELECT a.full_name,a.slug,a.author_randid,sum(av.views) as tot_author_views
            FROM authors AS a
            INNER JOIN author_views AS av ON a.author_randid = av.author_randid
            GROUP BY a.full_name
            ORDER BY tot_author_views DESC
            LIMIT " . intval($limit);
  $stmt = $conn->prepare($query);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $authorData = [];
    $authorData []= $row['full_name'];
    $authorData[]=$row['tot_author_views'];
    $authorData[]=$row['author_randid'];
     $authorData[]=$row['slug'];
    $authorsArray[] = $authorData;
  }

  return $authorsArray;
}


function getCategoryRandidFromArticle($conn, $articleRandid) {
  $query = "SELECT category_randid FROM articles WHERE article_randid = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$articleRandid]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return $row['category_randid'];
}

function getCategoryRandidFromSlug($conn, $slug) {
  $query = "SELECT category_randid FROM categories WHERE slug = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$slug]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return $row['category_randid'];
} 

function getAuthorRandidFromArticle($conn, $articleRandid) {
  $query = "SELECT author_randid FROM article_author WHERE article_randid = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$articleRandid]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return $row['author_randid'];
}

function updateArticleViews($conn, $articleRandid) {
  // Check if the article already exists in the article_views table
  $query = "SELECT * FROM article_views WHERE article_randid = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$articleRandid]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    // Article already exists, increment the views
    $query = "UPDATE article_views SET views = views + 1 WHERE article_randid = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$articleRandid]);
  } else {
    // Article doesn't exist, insert a new row with views = 1
    $query = "INSERT INTO article_views (article_randid, views) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$articleRandid, 1]);
  }
}

function updateCategoryViews($conn, $categoryRandid) {
  // Check if the category already exists in the category_views table
  $query = "SELECT * FROM category_views WHERE category_randid = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$categoryRandid]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    // Category already exists, increment the views
    $query = "UPDATE category_views SET views = views + 1 WHERE category_randid = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$categoryRandid]);
  } else {
    // Category doesn't exist, insert a new row with views = 1
    $query = "INSERT INTO category_views (category_randid, views) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$categoryRandid, 1]);
  }
}

function updateAuthorViews($conn, $authorRandid) {
  // Check if the author already exists in the author_views table
  $query = "SELECT * FROM author_views WHERE author_randid = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$authorRandid]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    // Author already exists, increment the views
    $query = "UPDATE author_views SET views = views + 1 WHERE author_randid = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$authorRandid]);
  } else {
    // Author doesn't exist, insert a new row with views = 1
    $query = "INSERT INTO author_views (author_randid, views) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$authorRandid, 1]);
  }
}

// function to get categories
function getCategories($conn){
  $categoriesArray = [];
  // Query to get the most viewed categories
  $query = "SELECT * FROM categories ORDER BY category_name ASC";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $categoryData = [];
    $categoryData []= $row['category_name'];
    $categoryData[]=$row['category_randid'];
    $categoryData[]=$row['description'];
    $categoryData[]=$row['slug'];
    $categoriesArray[] = $categoryData;
  }

  return $categoriesArray;
}


function generateArticleUrl($conn, $articleRandid){
    $stmt = $conn->prepare("SELECT slug FROM articles WHERE article_randid =?");
    $stmt->execute([$articleRandid]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $slug = $row['slug'];
        $url = 'www.sociolme.com/article/'.$slug;
        return $url;
    }

    return null;
}


function generateSlug($title, $id="") {
    // Remove any special characters from the title and convert spaces to hyphens
    $cleanTitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $title);
    if ($id != "") {
        $newTitle = $id . "-" . rtrim(strtolower($cleanTitle), '-');
    } else {
        $newTitle = rtrim(strtolower($cleanTitle), '-');
    }

    return $newTitle;
}



function fetchSearchedAuthors($conn, $predicate, $limit) {
  $authorsArray = [];

  // Get random articles from the selected author and category
  $authorQuery = "SELECT * FROM authors WHERE full_name LIKE '%" . $predicate . "%' ORDER BY full_name DESC LIMIT " . intval($limit);
  $authorStmt = $conn->prepare($authorQuery);
  $authorStmt->execute(); // Execute the prepared statement
  if($authorStmt->rowCount()>0){
    $authorResult = $authorStmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($authorResult as $authorRow) {
      $authorData = [];
      $authorData[] = $authorRow['author_randid'];
      $authorData[] = $authorRow['full_name'];
       $authorData[] = $authorRow['slug'];
      $authorsArray[] = $authorData;
    }
  }else{
    echo'<p class="text-dark bodyFont">Sorry,No Matching Authors Found.</p>';
  }
 

  // Return the random article ids
  return $authorsArray;
}

function fetchSearchedArticles($conn,$predicate,$limit){
    $articlesArray = [];
  // Get random articles from the selected author and category
  $articleQuery = "SELECT a.*, 
  au.full_name AS author_name,au.slug as authorslug, au.author_randid AS authorrand, c.category_name, c.category_randid,c.slug as catslug,
  c.description AS category_description FROM articles AS a
  INNER JOIN article_author AS aa ON a.article_randid = aa.article_randid
  INNER JOIN authors AS au ON aa.author_randid = au.author_randid
  INNER JOIN categories AS c ON a.category_randid = c.category_randid
  INNER JOIN article_views AS av ON a.article_randid = av.article_randid
  where a.publishstatus=? and a.title LIKE '%" . $predicate . "%' or a.content LIKE '%" . $predicate . "%'
  ORDER BY av.views desc LIMIT " . intval($limit);

  $articleStmt = $conn->prepare($articleQuery);
  $articleStmt->execute(["true"]);
  if($articleStmt->rowCount()>0){
    $articleResult = $articleStmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($articleResult as $articleRow) {
      $articleData = [];
      $articleData[] = $articleRow['article_randid'];
      $articleData[] = $articleRow['title'];
      $articleData[] = $articleRow['article_cover'];
      $articleData[] = ucwords($articleRow['category_name']);
      $articleData[] = $articleRow['category_description'];
      $articleData[] = $articleRow['date'];
      $articleData[] = $articleRow['authorrand'];
      $articleData[] = ucwords($articleRow['author_name']);
      $articleData[] = $articleRow['category_randid'];
      $strippedText = strip_tags($articleRow['content']); // Remove HTML tags
      $ellipsizedText = substr($strippedText, 0, 200); // Ellipsize text if needed
      $articleData[] = $ellipsizedText . ' ...';
      $articleData[] = $articleRow['slug'];
      $articleData[] = $articleRow['authorslug'];
      $articleData[] = $articleRow['catslug'];
      $articlesArray[] = $articleData;
    }
  
  }else{
    echo'<p class="text-danger lead  h3">Sorry, No Matching Articles Found.</p>';
  }

  // Return the random article ids
  return $articlesArray;

}

// check if email is verified
function isverifiedEmail($conn,$authorrandid){
    $query="select active_status from authors where author_randid=?";
    $st=$conn->prepare($query);
    $st->execute([$authorrandid]);
    if($st->rowCount()>0 ){
        $out=$st->fetch(PDO::FETCH_ASSOC);
        if($out['active_status']=="yes"){
            return true;
        }
        else{
        return false;
    }
    }else{
        return false;
    }
}


// gets the article_id of a given randomid
function getArticleId($conn,$randomId){
    $query="select article_id from articles where article_randid=?";
    $stmt=$conn->prepare($query);
    $stmt->execute([$randomId]);
    if($stmt->rowCount()>0){
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return $result['article_id'];
    }
}

?>