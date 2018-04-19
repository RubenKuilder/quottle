<?php
// Start the session
session_start();

//DATABASE CONNECTEN
$servername = 'localhost' ;
$username = 'root' ;
$password = 'root' ;
$databasename = 'quottle' ;
$conn = new mysqli($servername, $username, $password, $databasename);

if($conn -> connect_error){
    die('connection failed: '.$conn -> connect_error);
}

echo 'Connected';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo $_POST['login-email'];
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';

    $sql = "SELECT FROM users WHERE email = '".$_POST['login-email']."'";
    //$sql = "SELECT * FROM users WHERE email = "$_POST['login-email'];
    //$sql = "SELECT email FROM users";
    $result = $conn->query($sql);

echo $sql;
echo '<br />';
echo $result;
echo '<br />';
echo $result->num_rows;

    if ($result->num_rows > 0) {
        echo 'more than one result';
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if (CRYPT_BLOWFISH == 1) {
                if($row['password'] == crypt($_POST['login-pass'],'$2a$09$'.$row['pass_crypt'].'$')){
                //if($row['password'] == crypt($_POST['login-pass'], $row['pass_crypt'])){

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
        echo 'Less than one result';
    }
    //header( "refresh:5;url=home.html" );

//$sql = "SELECT FROM users WHERE email = ".$_POST['login-email'];
//$result = $conn->query($sql);
//if($result->num_rows>0){
//    while ($row = mysqli_fetch_assoc($result)){
//        echo '<br />';
//        echo '<br />';
//        echo $row['password'];
//        echo '<br />';
//        if (CRYPT_BLOWFISH == 1){
//            echo crypt($_POST['login-pass'],'$2a$09$'.$row['pass_crypt'].'$');
//        }
//    }
//}
?>