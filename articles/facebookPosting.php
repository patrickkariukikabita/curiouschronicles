<?php
// Load the Facebook PHP SDK
require_once '../resources/fb_graph_sdk/src/Facebook/autoload.php';
require_once '../resources/fb_graph_sdk/authentication.php';
use Facebook\Facebook;
echo $page_id;
// Replace 'your_app_id' and 'your_app_secret' with your actual values
$facebook = new Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v11.0',
]);


// Article details
$articleUrl = 'https://www.sociolme.com/article/19-minimum-viable-product'; // URL of the article
$message = '19-minimum-viable-product'; // The message to accompany the shared post

try {

    // Post to the page using the Graph API
    $response = $facebook->post("/$page_id/feed", [
      'link' => $articleUrl,
      'message' => $message,
    ], $access_token);

    // Get the Graph API response
    $graphNode = $response->getGraphNode();

    // Success message
    echo "Article shared on the page $page_id. Post ID: " . $graphNode['id'] . PHP_EOL;
  
} catch (Facebook\Exceptions\FacebookResponseException $e) {
  // Graph API Error
  echo 'Graph returned an error: ' . $e->getMessage();
} catch (Facebook\Exceptions\FacebookSDKException $e) {
  // SDK Error
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
}
?>
