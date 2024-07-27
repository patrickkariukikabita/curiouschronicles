<?php
// Replace these with your actual values
require_once './fb_graph_sdk/src/Facebook/autoload.php';
require_once './fb_graph_sdk/authentication.php';
$graphApiVersion = 'v11.0'; // Update to the latest available version
$appId = $app_id;
$appSecret = $app_secret;
$shortLivedToken = $access_token;

// API endpoint URL
$apiUrl = "https://graph.facebook.com/{$graphApiVersion}/oauth/access_token?" . http_build_query([
    'grant_type' => 'fb_exchange_token',
    'client_id' => $appId,
    'client_secret' => $appSecret,
    'fb_exchange_token' => $shortLivedToken,
]);

// Make the GET request to the Facebook API
$response = file_get_contents($apiUrl);

// Decode the JSON response
$responseData = json_decode($response, true);

if (isset($responseData['access_token'])) {
    $longLivedToken = $responseData['access_token'];
    echo "Long-Lived Token: {$longLivedToken}";

    // Write the long-lived token to a file
    $tokenFile = './token.txt';
    file_put_contents($tokenFile, $longLivedToken);
    echo "Long-Lived Token has been saved to 'token.txt'";

} else {
    // Handle error if long-lived token is not present in the response
    echo "Error: Unable to obtain long-lived token";
}
?>
