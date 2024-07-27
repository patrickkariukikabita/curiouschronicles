<?php
require_once '../resources/config.php';
$conn= DatabaseConnection::getInstance();
if (isset($_FILES['imageFile']['name'])&&$_FILES['imageFile']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['imageFile']['tmp_name'];
    $fileName = $_FILES['imageFile']['name'];
    $fileType = $_FILES['imageFile']['type'];
    $targetPath = '../cat_images/' . $fileName;
    $randomId = time() . mt_rand();
    // Check if the uploaded file is an image
    $allowedTypes =['image/jpeg', 'image/png', 'image/svg+xml', 'image/webp'];
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($fileTmpPath, $targetPath)) {
            // Image uploaded successfully
            $category_name = ucwords(strtolower(clean($_POST['category_name'])));
            $description = clean($_POST['description']);
            $cateslug=generateSlug($category_name);
            // Check if the category already exists
            $query = "SELECT COUNT(*) FROM categories WHERE category_name = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$category_name]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                echo -3; // Category already exists
            } else {
                // Insert the data into the database using PDO
                $query = "INSERT INTO categories (category_name, description,category_randid, image_path,slug) 
                VALUES (?, ?, ?,?,?)";
                $stmt = $conn->prepare($query);
                $stmt->execute([$category_name, $description,$randomId, $targetPath,$cateslug]);
                echo $randomId;
            }
        } else {
            echo 0; // Error occurred while moving the uploaded file
        }
    } else {
        echo -1; // Invalid file format
    }
} else {
    echo -2; // Error occurred during file upload
}


?>
