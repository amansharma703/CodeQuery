<?php 

session_start();
echo "Loggong you out, please wait...";
session_destroy();

header("Location: /forum");  
?>