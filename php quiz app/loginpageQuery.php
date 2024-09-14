<?php
session_start();

include "functions/functions.php";

if(!isset($_POST['username']) || !isset($_POST['passwd'])) {
    header(header: "Location: loginpage.php?message=Username and password must filled!");
    die();
}else {
    $username = htmlclean(text: $_POST['username']);
    $passwd = htmlclean(text: $_POST['passwd']);
    

    $result = login(username: $username,passwd: $passwd,);
    $rowCount = $result['count'];

    if($rowCount == 1){

        $_SESSION["id"] = $result["id"];
        $_SESSION["username"] = $result["username"];
        $_SESSION["isAdmin"] = $result["isAdmin"];

        
        header(header: "Location:index.php?message=Successful login!");
        
        exit();
    }else{
        
        header(header: "Location:loginpage.php?message=Wrong password or username!");
        
        exit();
    }


    



}










?>