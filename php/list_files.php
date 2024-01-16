<?php
$uploadDirectory = '../uploads/';

$files = scandir($uploadDirectory);
$files = array_diff($files, ['.', '..']);

echo json_encode(['files' => array_values($files)]);
?>
