<?php
session_start();
include "functions/functions.php";
$is_admin = $_SESSION["isAdmin"];
if ($is_admin == 0){
    header(header: "Location:index.php?message=You Dont Have Permission");
}
$questionid = $_GET["id"];

deleteQuestion(questionid: $questionid);

header(header: "Location:quests.php?searchinput=&diflvl=");
exit();

?>