<?php
session_start();

header( "refresh:2; url=home.php" );

$configs = include('config.php');

$sql = "INSERT INTO comments (postID, userID, comment) VALUES ('$_POST[postID]', '$_SESSION[id]', '$_POST[commentTxt]')";

if ($conn->query($sql)===TRUE){
    echo 'succesvol toegevoegd.';
} else{
    echo 'niet toegevoegd.';
    echo '<br />';
    echo 'Error:' . $sql . "<br /> <br />" . $conn->error;
}
?>