<?php
include "db.php";
$str_json = file_get_contents('php://input'); 
$response = json_decode($str_json, true);
$qid=$response['qid'];

$sqlQuery = "SELECT * FROM question WHERE `id` = '$qid'";
$query=$db->query($sqlQuery);
$res=$query->fetch();

print_r(json_encode(array('profCode'=>$res['code'], 'i1'=>$res['input1'], 'i2'=>$res['input2'], 'i3'=>$res['input3'], 'i4'=>$res['input4'] )));
?>