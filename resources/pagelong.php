<?php
// Replace these with your actual values
require_once './fb_graph_sdk/src/Facebook/autoload.php';
require_once './fb_graph_sdk/authentication.php';
$graphApiVersion = 'v11.0'; // Update to the latest available version
$appId = $app_id;
$appSecret = $app_secret;
$longLivedUserToken = $longlivedusertoken;

$fb = new Facebook\Facebook([
  'app_id' => $appId,
  'app_secret' => $appSecret,
  'default_graph_version' =>$graphApiVersion,
]);

try {
  // Make the API call to get the User's pages using the 'me/accounts' endpoint
  $response = $fb->get('/me/accounts', $longLivedUserToken);
  $data = $response->getGraphEdge()->asArray();

  // Check if there are any pages associated with the user
  if (!empty($data)) {
    // Assuming the first page in the response is the desired page
    $pageAccessToken = $data[0]['access_token'];

    // Save the page access token to a file
    file_put_contents('page_access_token.txt', $pageAccessToken);

    echo "Long-Lived Page Access Token: " . $pageAccessToken;
  } else {
    echo "No Pages associated with the user.";
  }
} catch (Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph API Error: ' . $e->getMessage();
} catch (Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK Error: ' . $e->getMessage();
}
?>
