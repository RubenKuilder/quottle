<?php
session_start();

header( "refresh:2; url=index.html" );

$configs = include('config.php');

if (CRYPT_BLOWFISH == 1){
    $items = array('A','b','1','24','3','Y','j');
    $salt = '';
    for($i = 0; $i < 30; $i++){
        $random = rand(0, sizeof($items));
        $salt = $salt.$items[$random];
    }
    //                echo "salt:".$salt;
    $hash = crypt($_POST['pass'],'$2a$09$'.$salt.'$');
    //                echo "Blowfish: ".$hash."\n<br>";
} else{
    echo "Blowfish DES not supported.\n<br>";
}

$sql = "INSERT INTO users (email, name, password, pass_crypt) VALUES ('$_POST[email]', '$_POST[name]', '$hash', '$salt')";

if ($conn->query($sql)===TRUE){
    echo 'succesvol toegevoegd.';
} else{
    echo 'niet toegevoegd.';
    echo '<br />';
    echo 'Error:' . $sql . "<br /> <br />" . $conn->error;
}

header( "refresh:5;url=index.html" );
?>