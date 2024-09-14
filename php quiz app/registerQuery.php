<?php
session_start();
include "functions/functions.php";

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    header(header: "Location: loginpage.php?message=You are already logged in!");
    die();
}


if (isset($_POST['username']) && isset($_POST['passwd']) && isset($_POST['admin'])) {
    $admin = $_POST['admin'];
    if($admin == 'admin'){
    $username = htmlclean(text: $_POST['username']);
    $passwd = htmlclean(text: $_POST['passwd']);
    $isadmin = 1 ;
    registerUser(username: $username,passwd: $passwd,isAdmin: $isadmin);
    header(header: "Location: loginpage.php");
    exit();
    }else{
        header(header: "Location: register.php?message=Wrong Admin Password");
        exit();
    }
}else {
    $username = htmlclean(text: $_POST['username']);
    $passwd = htmlclean(text: $_POST['passwd']);
    $isadmin = 0;
    registerUser(username: $username,passwd: $passwd,isAdmin: $isadmin);
    header(header: "Location: loginpage.php");
    exit();
}






?>