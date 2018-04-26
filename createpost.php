<?php
session_start();

header( "refresh:2; url=home.php" );

$configs = include('config.php');

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$quote = $_POST[quote];
$maxUsers = $result->num_rows;
$random_users = array();

$quote = str_replace('"','&#34;',$quote);
$quote = str_replace("'","&#39;",$quote);

sendTo(0);
function sendTo($i) {
    // (do the required processing...)
    $random_id = FLOOR( 1 + RAND(0, $GLOBALS['maxUsers']));
    $loopCount = 20;
    
    if ($GLOBALS['maxUsers'] < $loopCount) {
        $loopCount = $GLOBALS['maxUsers'] - 1;
    } else {
        $loopCount = 20;
    }
    
    if ( $i >= $loopCount ) {
        
        // end the recursion
        return;
    } else {

        if ($random_id == $_SESSION[id] || in_array($random_id, $GLOBALS['random_users'])) {
            
            sendTo($i);
        } else {
            $i++;
            array_push($GLOBALS['random_users'], $random_id);
            
            // continue the recursion
            sendTo($i);
        }
    }
}

$random_users_str = implode(" ",$random_users);

$quoteImg = $_POST[stockimg];
$targetDir = "assets/images/uploads/".basename($_FILES["imageUploader"]["name"]);
$uploadOk = 1;

if(!isset($_POST[stockimg]) || trim($_POST[stockimg]) == '') {
    $quoteImg = $_FILES["imageUploader"]['name'];
    
    if (move_uploaded_file($_FILES["imageUploader"]["tmp_name"], $targetDir)) {
        echo "The file ". basename( $_FILES["imageUploader"]["name"]). " has been uploaded.";
        echo '<br />';
        echo '<br />';
        $sql = "INSERT INTO posts (quote, img, userID, sendto) VALUES ('$quote', '$quoteImg', $_SESSION[id], '$random_users_str')";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else if (!isset($_POST[stockimg]) || trim($_POST[stockimg]) == '') {
    $quoteImg = 'stock1';
    
    $sql = "INSERT INTO posts (quote, img, userID, sendto) VALUES ('$quote', '$quoteImg', $_SESSION[id], '$random_users_str')";
} else {
    $sql = "INSERT INTO posts (quote, img, userID, sendto) VALUES ('$quote', '$quoteImg', $_SESSION[id], '$random_users_str')";
}

if ($conn->query($sql)===TRUE){
    echo 'succesvol toegevoegd.';
} else{
    echo 'niet toegevoegd.';
    echo '<br />';
    echo 'Error:' . $sql . "<br /> <br />" . $conn->error;
}
?>