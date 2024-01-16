<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDirectory = '../uploads/';

    $uploadedFile = $_FILES['file'];
    $uploadedFileName = $uploadDirectory . basename($uploadedFile['name']);

    if (move_uploaded_file($uploadedFile['tmp_name'], $uploadedFileName)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
