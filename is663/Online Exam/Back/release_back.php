<?php
	include "db.php";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	foreach($response as $r){
		$assest=$r['assest'];
		$id=$r['id'];
		$feedback=$r['feedback'];
		$sql="update `answer` set `assest`= '$assest', `feedback`='$feedback' where `id`='$id'";
		$query = $db->query($sql);
		$sql="update `answer` set `status`= 'released' where `id`='$id'";
		$query = $db->query($sql);
		if($query) echo "released success";
		else echo "fail";
	}
//	$sql="update `answer` set (`answer`) values('$ans') where `stdId`='$studentId' ans `quesId`='$qid'";
//	$query = $db->query($sql);
?>