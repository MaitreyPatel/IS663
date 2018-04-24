<?php
	include "db.php";
//	echo "back";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$name = $response['name'];
	if(isset($response['questions'])) $questions = $response['questions'];
	if(isset($response['points'])) $points=$response['points'];
	$count=count(split(" ",$points));
	$sql="UPDATE `exam` SET `status` = '1'";
	$db->query($sql);
	
	$sql="insert into `exam` (`name`, `questions`,`status`,`points`,`count`) VALUES ('$name','$questions','2','$points','$count')";
	$query = $db->query($sql);
	if($query)	echo "Add Exam Table is done successfuly";
	else echo "Add Exam Table is failed";
?>