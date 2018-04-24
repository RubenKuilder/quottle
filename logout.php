<?php
session_start();
session_destroy();
header( "refresh:2; url=index.html" );

echo "You've been logged out.";
?>