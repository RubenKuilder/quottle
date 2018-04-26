<?php
session_start();

//header( "refresh:2; url=home.php" );

$configs = include('config.php');

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$maxUsers = $result->num_rows;

$random_users = array();
//for($i = 0; $i < 10; $i++) {
//    array_push($random_users, FLOOR( 1 + RAND(0, $maxUsers)));
//    
//    //Create array with random users, but exclude session[id]
//    //while(in_array(array_push($random_users, FLOOR( 1 + RAND(1, $maxUsers))), array($_session[id])));
//}
//
//$random_users_str = implode(" ",$random_users);
////If creating an array while excluding session[id] doesn't work, use this. It replaces the session[id] with an empty string.
//echo $_SESSION[id].'<br />';
//$random_users_str = str_replace($_SESSION[id].' ','',$random_users_str);
//$random_users_str = str_replace(' '.$_SESSION[id],'',$random_users_str);
createUserArray();

function createUserArray() {
 
    for($i = 0; $i < $maxUsers) {
        $random_id = FLOOR( 1 + RAND(0, $maxUsers));

        if ($random_id == $_SESSION[id] || in_array($random_id, $random_users)) {
            createUserArray();
        } else {
            $i++;
            array_push($random_users, $random_id);
            createUserArray();
        }
    }
    return;
}

//$sql = "INSERT INTO posts (quote, img, userID, sendto) VALUES ('$_POST[quote]', '$_POST[stockimg]', $_SESSION[id], '$random_users_str')";
//
//if ($conn->query($sql)===TRUE){
//    echo 'succesvol toegevoegd.';
//} else{
//    echo 'niet toegevoegd.';
//    echo '<br />';
//    echo 'Error:' . $sql . "<br /> <br />" . $conn->error;
//}
?>