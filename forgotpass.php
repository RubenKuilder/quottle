<?php
session_start();

header('Location: index.php');

$configs = include('config.php');

$items = array('A','b','1','24','3','Y','j');
$salt = '';
for($i = 0; $i < 30; $i++){
    $random = rand(0, sizeof($items));
    $salt = $salt.$items[$random];
}
echo "salt:".$salt;

$sql = "UPDATE users SET reset_crypt = $salt WHERE email = '".$_POST[email]."'";

if ($conn->query($sql)===TRUE){
    //Email information
    $admin_email = "rubenkuilder@gmail.com";
    $email = $_POST['email'];
    $subject = 'Quottle - Reset password';
    $comment = 'rubenkuilder.com/quottle?email='.$_POST['email'].'&user='.salt;

    //send email
    mail($admin_email, $subject, $comment, "From:" . $email);

    //Email response
    echo "Thank you for contacting us!";
    echo $comment;
    }
} else{
    echo 'niet toegevoegd.';
    echo '<br />';
    echo 'Error:' . $sql . "<br /> <br />" . $conn->error;
}
?>