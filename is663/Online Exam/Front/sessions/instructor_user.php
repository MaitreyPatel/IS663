<?php 
include "conf.php";
session_start();
    if($_SESSION['authority'] != 'instructor'){
        header("Location: ".$FRONT_PATH."login.php");
        exit();
    }
?>