<?php 
include "conf.php";
session_start();
    if($_SESSION['authority'] != 'student'){
        header("Location: ".$FRONT_PATH."login.php");
        exit();
    }
?>