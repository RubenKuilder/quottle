<?php
session_start();

$configs = include('config.php');

$postId = $_POST['postId'];
$update = $_POST['update'];

//echo '<br />'.$postId.'<br />'.$_SESSION['id'].'<br />';

//$sql = "SELECT userLikes FROM posts WHERE id = '".$postId."'";
//$result = $conn->query($sql);

$sql = "SELECT * FROM posts WHERE id = '".$postId."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $likeAmount = $row['likeCount'];
    }
} else {
    echo '0 likes';
}

if ($update == 'remove') {
    //$sql = "UPDATE posts SET likeCount = 'likeCount - 1' WHERE id = '".$postId."'";
    $likeCount = "UPDATE posts SET likeCount = likeCount - 1 WHERE id = '".$postId."'";
    $userLikes = "UPDATE posts SET userLikes = REPLACE(userLikes, '".$_SESSION['id']."', '') WHERE id = '".$postId."'";
    //echo 'removed';
    
    echo ($likeAmount - 1).' likes';
    //echo implode($likeAmount).' likes';
    //echo '-1 like';
    
    //$sql = "UPDATE posts SET userLikes =  WHERE id=2";
} else {
    //$likeCount = "UPDATE posts SET likeCount = likeCount + 1 WHERE id = '".$postId."'";
    $likeCount = "UPDATE posts SET likeCount = likeCount + 1 WHERE id = '".$postId."'";
    $userLikes = "UPDATE posts SET userLikes = CONCAT(userLikes, ' ".$_SESSION['id']."') WHERE id = '".$postId."'";
    //echo 'added';
    
    //var_dump($ids);
    echo ($likeAmount + 1).' likes';
    //echo implode($likeAmount).' likes';
    //echo '+1 like';
}

if ($conn->query($likeCount) === TRUE) {
//    echo "<br />";
//    echo "<br />";
//    echo "Like count: ";
//    echo "Record updated successfully";
} else {
//    echo "<br />";
//    echo "<br />";
//    echo "Like count: ";
//    echo "Error updating record: " . $conn->error;
}

if ($conn->query($userLikes) === TRUE) {
//    echo "<br />";
//    echo "<br />";
//    echo "User Likes: ";
//    echo "Record updated successfully";
} else {
//    echo "<br />";
//    echo "<br />";
//    echo "User Likes: ";
//    echo "Error updating record: " . $conn->error;
}
?>