<?php
session_start();

include "functions/functions.php";

if(isset($_POST['questname']) && isset($_POST['selection1']) && isset($_POST['selection2']) && isset($_POST['selection3']) && isset($_POST['selection4'])) {

    $questionid = $_GET["id"];
    $questname = htmlclean(text: $_POST['questname']);
    $selection1 = htmlclean(text: $_POST['selection1']);
    $selection2 = htmlclean(text: $_POST['selection2']);
    $selection3 = htmlclean(text: $_POST['selection3']);
    $selection4 = htmlclean(text: $_POST['selection4']);
    editQuestion(questname: $questname,selection1: $selection1,selection2: $selection2,selection3: $selection3,selection4: $selection4,questionid: $questionid);
    header(header: "Location: quests.php?searchinput=&diflvl=");
    exit();
}







?>