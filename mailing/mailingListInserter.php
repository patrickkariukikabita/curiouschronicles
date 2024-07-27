<?php
require_once '../resources/config.php';
$conn = DatabaseConnection::getInstance();

if (isset($_POST['email']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = clean($_POST['email']);
    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 0; // Invalid email format
    } else {
        $query = "INSERT INTO mailing_list (email) VALUES (?)";
        $stmt = $conn->prepare($query);
        if ($stmt->execute([$email])) {
            echo 1; // Email inserted successfully
        } else {
            echo 2; // Failed to insert email
        }
    }
} else {
    echo 3; // Email not provided
}
?>
