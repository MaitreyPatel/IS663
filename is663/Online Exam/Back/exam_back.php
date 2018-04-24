<?php
	include "db.php";
//	echo "back";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	
	$sql="select * from exam";
	$query = $db->query($sql);
	$result=$query->fetchAll();
	$data=[];
	foreach ($result as $row){
		$data[]=array('id'=>$row['id'], 'name'=> $row['name'],'questions'=>$row['questions']);
	}
	echo json_encode($data);
?>