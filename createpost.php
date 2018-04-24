<?php
session_start();

header( "refresh:10; url=index.html" );

$configs = include('config.php');

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$maxUsers = $result->num_rows;

$random_users = array();
for($i = 0; $i < 10; $i++) {
    array_push($random_users, FLOOR( 1 + RAND(0, $maxUsers)));
}

$random_users_str = implode(" ",$random_users);

$sql = "INSERT INTO posts (quote, img, userID, sendto) VALUES ('$_POST[quote]', '$_POST[stockimg]', $_SESSION[id], '$random_users_str')";

if ($conn->query($sql)===TRUE){
    echo 'succesvol toegevoegd.';
} else{
    echo 'niet toegevoegd.';
    echo '<br />';
    echo 'Error:' . $sql . "<br /> <br />" . $conn->error;
}
?>