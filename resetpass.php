<?php
session_start();

//header( "refresh:2; url=index.php" );

$configs = include('config.php');

$email = $_GET[email];
$user = $_GET[user];

$sql = "UPDATE users SET password = '".$_POST[password]."' WHERE email = '".$_POST[email]."'";

if ($conn->query($sql)===TRUE){
    //Email information
    $admin_email = "rubenkuilder@gmail.com";
    $email = $_POST['email'];
    $subject = 'Quottle - Reset password';
    $comment = 'rubenkuilder.com/quottle?user='.salt;

    //send email
    mail($admin_email, "$subject", $comment, "From:" . $email);

    //Email response
    echo "Thank you for contacting us!";
    }
} else{
    echo 'niet toegevoegd.';
    echo '<br />';
    echo 'Error:' . $sql . "<br /> <br />" . $conn->error;
}
?>