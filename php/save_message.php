<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $message = $_POST["message"];
    
    if (!empty($name) && !empty($message)) {
        // Define the path to the text file where messages will be stored
        $file = "../discussions/messages.txt";

        // Create or open the text file for appending
        $fileHandle = fopen($file, "a");

        if ($fileHandle) {
            // Format the message and save it to the file
            $formattedMessage = "$name: $message\n";
            fwrite($fileHandle, $formattedMessage);

            // Close the file handle
            fclose($fileHandle);
        }
    }
}
?>
