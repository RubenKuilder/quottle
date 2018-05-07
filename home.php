<?php
    session_start();

    if ($_SESSION['id'] == "") {
        header('Location: index.php');
    
        exit();
    }

    $configs = include('config.php');
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Quottle</title>
	<meta name="Author" content="Ruben Kuilder"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
	<link rel="stylesheet" type="text/css" href="assets/style/main.css">
    <script src="assets/script/main.js"></script>
</head>
<body>
    
    <div class="topbar">
        <a href="logout.php" class="icon-signout"><img src="assets/images/signout.svg" /></a>
        <img class="icon-left" src="assets/images/icon-left.svg" />
        <img class="logo" src="assets/images/logo.png" />
        <input class="submit-btn" type="submit" value="Send" form="createQuoteForm" />
    </div>
    <div class="bottombar">
        <img class="logo" src="assets/images/logo.png" />
        <img class="icon-home show-home" src="assets/images/icon-home.svg" />
        <img class="icon-add show-create" src="assets/images/icon-add.svg" />
        <img class="icon-profile show-profile" src="assets/images/icon-profile.svg" />
        <a href="logout.php" class="icon-signout"><img src="assets/images/signout.svg" /></a>
    </div>
    
    <div class="page-container">
        <div class="home-page">
            <div class="postlist-container">
            <?php

                $sql = "SELECT * FROM posts WHERE sendTo REGEXP '".$_SESSION['id']."' ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        
                        echo '<div class="post">';
                        
                            $selectUser = "SELECT name FROM users WHERE id = '".$row['userID']."'";
                            $username = $conn->query($selectUser);
                            if ($username->num_rows > 0) {
                                // output data of each row
                                while($userRow = $username->fetch_assoc()) {
                                    echo '<h3>'.$userRow['name'].'</h3>';
                                }
                            }
                            echo '<div class="postimage-container show-single" data-postID="'.$row['id'].'">
                                <h2>'.$row['quote'].'</h2>
                                <img src="assets/images/uploads/'.$row['img'].'" />
                            </div>
                            <div class="post-bottombar">
                                    <div class="likecount-container ">';

                                    if(preg_match('/'.$_SESSION['id'].'/',$row['userLikes'])){
                                        echo '<svg version="1.1" class="heart active" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                        <path fill="none" stroke="#000000" stroke-width="1.859" stroke-miterlimit="10" d="M44.604,8.81 c-4.426-4.426-11.669-4.426-16.094,0L25,12.32l-3.51-3.51c-4.426-4.426-11.669-4.426-16.094,0s-4.426,11.669,0,16.094l3.51,3.51 L25,44.509l16.094-16.094l3.51-3.51C49.031,20.479,49.031,13.236,44.604,8.81z"/></svg>';
                                    } else {
                                        echo '<svg version="1.1" class="heart" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                        <path fill="none" stroke="#000000" stroke-width="1.859" stroke-miterlimit="10" d="M44.604,8.81 c-4.426-4.426-11.669-4.426-16.094,0L25,12.32l-3.51-3.51c-4.426-4.426-11.669-4.426-16.094,0s-4.426,11.669,0,16.094l3.51,3.51 L25,44.509l16.094-16.094l3.51-3.51C49.031,20.479,49.031,13.236,44.604,8.81z"/></svg>';
                                    }
                                    echo '<p>'.$row['likeCount'].' likes</p>
                                </div>';
                                $selectComments = "SELECT * FROM comments WHERE postID = '".$row['id']."'";
                                $comments = $conn->query($selectComments);
                                if ($comments->num_rows > 0) {
                                    echo '<div class="commentcount-container">
                                        <svg version="1.1" class="balloon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                            <path fill="none" stroke="#000000" stroke-width="1.8586" stroke-miterlimit="10" d="M47,24c0,10.493-9.85,19-22,19 c-2.076,0-4.085-0.248-5.99-0.712c0,0-3.807,4.739-10.01,4.712c3.001-4.258,2.996-7.673,2.996-7.673C6.541,35.869,3,30.292,3,24 C3,13.507,12.849,5,25,5C37.15,5,47,13.507,47,24z"/>
                                        </svg>';
                                        echo '<p>'.$comments->num_rows.' comments</p>';
                                    }
                                echo '</div>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<div class="noPosts">No posts received yet.</div>';
                }
                ?>
            </div>
        </div>
        
        <div class="profile-page">
            <div class="postlist-container">
               <?php

                $sql = "SELECT * FROM posts WHERE userID = '".$_SESSION['id']."'ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {

                        echo '<div class="post">';
                            $selectUser = "SELECT name FROM users WHERE id = '".$row['userID']."'";
                            $username = $conn->query($selectUser);
                            if ($username->num_rows > 0) {
                                // output data of each row
                                while($userRow = $username->fetch_assoc()) {
                                    echo '<h3>'.$userRow['name'].'</h3>';
                                }
                            }
                            echo '<div class="postimage-container show-single profile-post" data-postID="'.$row['id'].'">
                                <h2>'.$row['quote'].'</h2>
                                <img src="assets/images/uploads/'.$row['img'].'" />
                            </div>
                            <div class="post-bottombar">
                                <div class="likecount-container">';

                                    if(preg_match('/'.$_SESSION['id'].'/',$row['userLikes'])){
                                        echo '<svg version="1.1" class="heart active" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                        <path fill="none" stroke="#000000" stroke-width="1.859" stroke-miterlimit="10" d="M44.604,8.81 c-4.426-4.426-11.669-4.426-16.094,0L25,12.32l-3.51-3.51c-4.426-4.426-11.669-4.426-16.094,0s-4.426,11.669,0,16.094l3.51,3.51 L25,44.509l16.094-16.094l3.51-3.51C49.031,20.479,49.031,13.236,44.604,8.81z"/></svg>';
                                    } else {
                                        echo '<svg version="1.1" class="heart" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                        <path fill="none" stroke="#000000" stroke-width="1.859" stroke-miterlimit="10" d="M44.604,8.81 c-4.426-4.426-11.669-4.426-16.094,0L25,12.32l-3.51-3.51c-4.426-4.426-11.669-4.426-16.094,0s-4.426,11.669,0,16.094l3.51,3.51 L25,44.509l16.094-16.094l3.51-3.51C49.031,20.479,49.031,13.236,44.604,8.81z"/></svg>';
                                    }
                                    echo '<p>'.$row['likeCount'].' likes</p>
                                </div>
                                <div class="commentcount-container">
                                    <svg version="1.1" class="balloon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                        <path fill="none" stroke="#000000" stroke-width="1.8586" stroke-miterlimit="10" d="M47,24c0,10.493-9.85,19-22,19 c-2.076,0-4.085-0.248-5.99-0.712c0,0-3.807,4.739-10.01,4.712c3.001-4.258,2.996-7.673,2.996-7.673C6.541,35.869,3,30.292,3,24 C3,13.507,12.849,5,25,5C37.15,5,47,13.507,47,24z"/>
                                    </svg>
                                    <p>10 comments</p>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<div class="noPosts">No posts sent yet. Click on the &#43; icon at the bottom to send your first message!</div>';
                }
                ?>
            </div>
        </div>
        
        <div class="single-page">
        </div>
        
        <div class="create-page">
            <div class="post">
                <form id="createQuoteForm" action="createpost.php" method="post" enctype="multipart/form-data">
                    <div class="postimage-container">
                            <textarea maxlength="60" name="quote" placeholder="Tap to write your quote" required></textarea>
                        <img src="assets/images/uploads/stock1.jpg" />
                    </div>
                    <div class="stockphotos-container">
                        <div class="stockphoto">
                            <input type="checkbox" name="stockimg" value="stock1.jpg" />
                            <img src="assets/images/uploads/stock1.jpg" />
                        </div>
                        <div class="stockphoto">
                            <input type="checkbox" name="stockimg" value="stock2.jpg" />
                            <img src="assets/images/uploads/stock2.jpg" />
                        </div>
                        <div class="stockphoto">
                            <input type="checkbox" name="stockimg" value="stock3.jpg" />
                            <img src="assets/images/uploads/stock3.jpg" />
                        </div>
                        <div class="stockphoto">
                            <input type="checkbox" name="stockimg" value="stock4.jpg" />
                            <img src="assets/images/uploads/stock4.jpg" />
                        </div>
                        <div class="stockphoto">
                            <input type="checkbox" name="stockimg" value="stock5.jpg" />
                            <img src="assets/images/uploads/stock5.jpg" />
                        </div>
                        <div class="stockphoto">
                            <input type="checkbox" name="stockimg" value="stock6.jpg" />
                            <img src="assets/images/uploads/stock6.jpg" />
                        </div>
                        <div class="stockphoto">
                            <input type="checkbox" name="stockimg" value="stock7.jpg" />
                            <img src="assets/images/uploads/stock7.jpg" />
                        </div>
                        <div class="stockphoto">
                            <input type="checkbox" name="stockimg" value="stock8.jpg" />
                            <img src="assets/images/uploads/stock8.jpg" />
                        </div>
                        <div class="stockphoto">
                            <input type="checkbox" name="stockimg" value="stock9.jpg" />
                            <img src="assets/images/uploads/stock9.jpg" />
                        </div>
                        <div class="stockphoto">
                            <input type="checkbox" name="stockimg" value="stock10.jpg" />
                            <img src="assets/images/uploads/stock10.jpg" />
                        </div>
                    </div>
                    <input class="takephoto-btn" type="file" name="imageUploader" placeholder="Take a photo" accept="image/*" capture="camera">
                </form>
            </div>
        </div>
    </div>

</body>
</html>
