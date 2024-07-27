<?php require_once"../resources/config.php";
$conn= DatabaseConnection::getInstance();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="HandheldFriendly" content="true">
  <link rel="shortcut icon" href="../logos/logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title><?php echo  "Page Not Found - " . $sitename; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
    /* 404 Page Styles */
    .error-page {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      flex-direction: column;
      text-align: center;
      font-family: Arial, sans-serif;
    }
    .error-page .error-code {
      font-size: 10rem;
      font-weight: bold;
      color: #d24d33;
    }
    .error-page .error-message {
      font-size: 2rem;
      margin-top: 2rem;
    }

</style>
</head>
<body class="bg-dark" >
  <!-- 404 Page -->
  <div class="error-page">
    <div class="error-code">404</div>
    <div class="error-message text-light">Oops! Lost in Space 🚀.</div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../menu/menu.js?v=<?php echo time?>"></script>
  <script>
     menuPropagation()
  </script>
</body>
</html>
