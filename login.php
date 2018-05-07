<?php
session_start();

header('Location: home.php');

$configs = include('config.php');

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