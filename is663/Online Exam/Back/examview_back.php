<?php
	include "db.php";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$questions="";
	if(isset($response['questions'])) $questions = $response['questions'];
	$q_ids=[];
	$q_ids=split(" ",$questions);
	$data=[];
	foreach($q_ids as $q){
		$sql="select * from question where `id` = '$q'";
		$query = $db->query($sql);
		$result=$query->fetch();
		$data[]=array("id"=>$result['id'],
					  "name"=>$result['name'],
					  "level"=>$result['level'],
					  "description"=>$result['description']);
	}
	echo json_encode($data);
?>