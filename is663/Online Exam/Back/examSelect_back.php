<?php
	include "db.php";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$id=$response['id'];
	if(isset($response['name'])) $name = $response['name'];
	if(isset($response['questions'])) $level = $response['questions'];
	
	$sql="update `exam` set `status`='2' where `id` = '$id'";
	$query = $db->query($sql);
	if($query)	{echo "ExamTable"; echo $id; echo " is done successfuly";}
	else {echo "ExamTable"; echo $id; echo " was not selected";}
?>