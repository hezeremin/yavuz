<?php 
session_start();

session_unset();
session_destroy();

header(header: "Location: loginpage.php");
exit;
?>