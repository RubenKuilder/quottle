<?php
$servername = 'localhost' ;
$username = 'root' ;
$password = 'root' ;
$databasename = 'quottle' ;
$conn = new mysqli($servername, $username, $password, $databasename);

if($conn -> connect_error){
    die('connection failed: '.$conn -> connect_error);
}