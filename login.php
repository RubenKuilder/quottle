<?php
// Start the session
session_start();

//DATABASE CONNECTEN
$servername = 'localhost';
$username = 'root';
$password = 'root';
$databasename = 'quottle';
$conn = new mysqli($servername, $username, $password, $databasename);

if($conn -> connect_error){
    die('connection failed: '.$conn -> connect_error);
}

$sql = "SELECT * FROM users WHERE email = '".$_POST['login-email']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if (CRYPT_BLOWFISH == 1) {
            if($row['password'] == crypt($_POST['login-pass'],'$2a$09$'.$row['pass_crypt'].'$')) {

                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];

                echo 'you are logged in now ';

            } else {
                echo 'login failed';
            }
        }
    }
} else {
    echo 'User does not exist.';
}
?>