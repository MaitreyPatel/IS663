<?php
	include "db.php";
//	echo "back";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	 
	$level="none";
	if(isset($response['level'])) $level = $response['level'];
	
	$sql="select * from question where `level` = '$level'";
	$query = $db->query($sql);
	$result=$query->fetchAll();
//	if($result) echo "project accept";
//	else echo "project reject";
//	echo count($result);
//	echo json_encode($result);
	$data=[];
	foreach ($result as $row){
		$data[]=array('name'=> $row['name'],'level'=>$row['level']);
	}
	echo json_encode($data);
?>

