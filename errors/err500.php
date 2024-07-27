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
  <title><?php echo  "Interal Server Error - " . $sitename; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../menu/menu.css?">

</head>
<body class="bg-light" data-categoryrandid="<?php echo $category_randid ?>">
<?php include '../menu/menu.php'?>

  <!-- 500 Page -->
  <div class="error-page">
    <div class="error-code">500</div>
    <div class="error-message">Sorry, We experienced An Internal Server Error.</div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../menu/menu.js?v=<?php echo time?>"></script>
  <script>
     menuPropagation()
  </script>
</body>
</html>
