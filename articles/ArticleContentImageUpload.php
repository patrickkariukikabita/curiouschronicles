<?php
// Specify the target directory where the uploaded images will be stored
$targetDirectory = '../articleImageUploads/';

// Allowed image extensions
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

// Check if the HTTP POST request contains an uploaded file
if (isset($_FILES['file'])) {
    $uploadedFile = $_FILES['file']['tmp_name'];
    $originalFilename = $_FILES['file']['name'];
    $fileExtension = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));

    // Verify the image extension
    if (in_array($fileExtension, $allowedExtensions)) {
        // Generate a unique filename for the uploaded image
        $newFilename = uniqid('image_') . '.' . $fileExtension;
        $targetFile = $targetDirectory . $newFilename;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($uploadedFile, $targetFile)) {
            // Get the remote location and filename of the uploaded image
            $location = ltrim($targetFile, '/');

            // Image upload was successful
            $response = [
                'location' => $location
            ];
        } else {
            // Image upload failed
            $response = [
                'error' => 'Image upload failed.'
            ];
        }
    } else {
        // Invalid image extension
        $response = [
            'error' => 'Invalid image extension. Allowed extensions are: ' . implode(', ', $allowedExtensions)
        ];
    }
} else {
    // No file was uploaded
    $response = [
        'error' => 'No file was uploaded.'
    ];
}

// Set the appropriate headers for JSON response
header('Content-Type: application/json');

// Output the response as JSON
echo json_encode($response);
?>
