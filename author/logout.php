<?php
session_start(); // Start the session
require_once '../resources/config.php';
$client->revokeToken();
unset($_SESSION['access_token']);
unset($_SESSION['loggedin']);
unset($_SESSION['author_randid']);
// Unset all of the session variables
$_SESSION = array();
// Destroy the session
session_destroy();
// Destroy the cookies
setcookie("AuthToken0", "", time() - 3600, "/");
setcookie("AuthToken1", "", time() - 3600, "/");
// Redirect to the login page or any other page you desire
header("Location: authorLogin.php");
exit();
?>
