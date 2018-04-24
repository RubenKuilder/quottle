<?php
session_start();

$configs = include('config.php');

$sql = "SELECT * FROM users WHERE email = '".$_POST['login-email']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        //$row['pass_crypt']
    }
} else {
    echo 'User does not exist.';
}
?>