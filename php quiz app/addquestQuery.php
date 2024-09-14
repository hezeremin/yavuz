<?php
include "functions/functions.php";
session_start();

if (isset($_POST['questname']) && isset($_POST['selection1']) && isset($_POST['selection2']) && isset($_POST['selection3']) && isset($_POST['selection4']) && isset($_POST['correctanswer']) && isset($_POST['diflvl'])) {
    $questname = htmlclean(text: $_POST['questname']);
    $selection1 = htmlclean(text: $_POST['selection1']);
    $selection2 = htmlclean(text: $_POST['selection2']);
    $selection3 = htmlclean(text: $_POST['selection3']);
    $selection4 = htmlclean(text: $_POST['selection4']);
    $correctanswer = ($_POST['correctanswer']);
    $diflvl = ($_POST['diflvl']);
    registerQuestion(questname: $questname,selection1: $selection1,selection2: $selection2,selection3: $selection3,selection4: $selection4,correctanswer: $correctanswer,diflvl: $diflvl);
    header(header: "Location: quests.php?searchinput=&diflvl=");
    exit();
}

?>