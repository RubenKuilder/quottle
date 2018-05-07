<?php
session_start();
session_destroy();
header('Location: index.php');

echo "You've been logged out.";
?>