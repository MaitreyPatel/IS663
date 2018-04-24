<?php 
include "conf.php";
session_start();
    if($_SESSION['authority'] === 'student'){
        header("Location: ".$FRONT_PATH."student_front.php");
        exit();
    } else if($_SESSION['authority'] === 'instructor'){
        header("Location: ".$FRONT_PATH."instructor_front.php");
        exit();
    } 
?>