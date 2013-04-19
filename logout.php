<?php
include("config.php");
session_destroy();

echo "<head><link href='css/qmail.css' rel='stylesheet' type='text/css' /></head>";

echo "You have sucessfully logged out!";
header('Refresh: 1; URL='.REDIRECT);
?>