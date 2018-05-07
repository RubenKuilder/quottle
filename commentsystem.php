<?php
session_start();

header( "refresh:2; url=home.php" );

$configs = include('config.php');

$sql = "INSERT INTO comments (postID, userID, comment) VALUES ('$_POST[postID]', '$_SESSION[id]', '$_POST[commentTxt]')";

if ($conn->query($sql)===TRUE){
    echo '<p><span class="username">'.$_SESSION[name].'</span>'.$_POST[commentTxt].'</p>';
} else{
    echo 'Something went wrong while sending your comment.';
}
?>