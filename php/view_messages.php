<?php
// Define the path to the text file containing messages
$file = "../discussions/messages.txt";

if (file_exists($file)) {
    // Read the contents of the file
    $messages = file_get_contents($file);

    // Display the messages
    echo nl2br($messages);
} else {
    echo "No messages yet.";
}
?>
