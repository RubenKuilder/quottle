<?php
session_start();

$configs = include('config.php');

$postId = $_POST['postId'];

$sql = "SELECT * FROM posts WHERE id = '".$postId."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo '<div class="background-overlay"></div>
        <img class="icon-cross" src="assets/images/icon-cross.svg" />
        <div class="post">';
        
            $selectUser = "SELECT * FROM users WHERE id = '".$row['userID']."'";
            $username = $conn->query($selectUser);
            if ($username->num_rows > 0) {
                // output data of each row
                while($userRow = $username->fetch_assoc()) {
                    echo '<h3 class="userTitle">'.$userRow['name'].'</h3>';
                }
            }
            echo '<div class="postimage-container show-single profile-post" data-postID="'.$row['id'].'">
                <h2>'.$row['quote'].'</h2>
                <img src="assets/images/uploads/'.$row['img'].'" />
            </div>
            <div class="post-bottombar">
                <div class="likeComment-container">
                    <div class="likecount-container">';

                        if(preg_match('/'.$_SESSION['id'].'/',$row['userLikes'])){
                            echo '<svg version="1.1" class="heart active" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                            <path fill="none" stroke="#000000" stroke-width="1.859" stroke-miterlimit="10" d="M44.604,8.81 c-4.426-4.426-11.669-4.426-16.094,0L25,12.32l-3.51-3.51c-4.426-4.426-11.669-4.426-16.094,0s-4.426,11.669,0,16.094l3.51,3.51 L25,44.509l16.094-16.094l3.51-3.51C49.031,20.479,49.031,13.236,44.604,8.81z"/></svg>';
                        } else {
                            echo '<svg version="1.1" class="heart" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                            <path fill="none" stroke="#000000" stroke-width="1.859" stroke-miterlimit="10" d="M44.604,8.81 c-4.426-4.426-11.669-4.426-16.094,0L25,12.32l-3.51-3.51c-4.426-4.426-11.669-4.426-16.094,0s-4.426,11.669,0,16.094l3.51,3.51 L25,44.509l16.094-16.094l3.51-3.51C49.031,20.479,49.031,13.236,44.604,8.81z"/></svg>';
                        }
                        echo '<p><span class="likeInt">'.$row['likeCount'].'</span> likes</p>
                    </div>
                    <div class="commentcount-container">';
                    $selectComments = "SELECT * FROM comments WHERE postID = '".$row['id']."'";
                    $comments = $conn->query($selectComments);
                    echo '<svg version="1.1" class="balloon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                        <path fill="none" stroke="#000000" stroke-width="1.8586" stroke-miterlimit="10" d="M47,24c0,10.493-9.85,19-22,19 c-2.076,0-4.085-0.248-5.99-0.712c0,0-3.807,4.739-10.01,4.712c3.001-4.258,2.996-7.673,2.996-7.673C6.541,35.869,3,30.292,3,24 C3,13.507,12.849,5,25,5C37.15,5,47,13.507,47,24z"/>
                    </svg>';
                    echo '<p><span class="commentInt">'.$comments->num_rows.'</span> comments</p>';
                    echo '</div>
                </div>
        
                <div class="comment-container">';
                if ($comments->num_rows > 0) {
                    // output data of each row
                    while($commentRow = $comments->fetch_assoc()) {
                        echo '<p>';
                        $selectUser2 = "SELECT name FROM users WHERE id = '".$commentRow['userID']."'";
                        $username2 = $conn->query($selectUser2);
                        if ($username2->num_rows > 0) {
                            // output data of each row
                            while($userRow2 = $username2->fetch_assoc()) {
                                echo '<span class="username">'.$userRow2['name'].'</span>';
                            }
                        }
                        echo $commentRow['comment'].'</p>';
                    }
                }
                
                echo '</div>
                <form id="comment-form" action="commentsystem.php" method="post">
                    <input class="comment-input" type="text" placeholder="Write a comment..." name="commentTxt" required />
                    <input type="hidden" value="'.$row['id'].'" name="postID" />
                    <div class="submit-btn">
                        <img src="assets/images/icon-checkmark.svg" />
                        <input class="comment-submit" type="submit" value="" />
                    </div>
                </form>
            </div>
        </div>';
        
    }
} else {
    echo '<div class="noPosts">No posts sent yet. Click on the &#43; icon at the bottom to send your first message!</div>';
}
?>