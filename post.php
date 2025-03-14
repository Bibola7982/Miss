<?php
session_start();

if (isset($_SESSION['name'])) {
    $text = $_POST['text'];

    // Set the timezone to Indian Standard Time (IST)
    date_default_timezone_set('Asia/Kolkata');
    
    // Get the current time in IST
    $current_time = date("g:i A");
    
    $text_message = "<div class='msgln'><span class='chat-time'>" . $current_time . "</span> <b class='user-name'>" . $_SESSION['name'] . "</b> " . stripslashes(htmlspecialchars($text)) . "<br></div>";

    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
}
?>
