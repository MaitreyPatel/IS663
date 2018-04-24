<?php
	include "db.php";

	// 10/13 ADDED TOPIC

	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$userId=$response['userId'];
	$sql="select * from users where `id`='$userId'";
	$query = $db->query($sql);
	$result=$query->fetch();
	$auth=$result['authority'];
	$username=$result['username'];
	
	if($auth.trim(" ")=="instructor".trim(" ")){
	
		$sql="select * from question";
		$query = $db->query($sql);
		$result=$query->fetchAll();
		$data=[];
		foreach ($result as $row){
			$data[]=array('id'=>$row['id'],
						  'name'=> $row['name'],
						  'description'=>$row['description'],
						  'level'=>$row['level'],
						  'category'=>$row['category'],
						  'code'=>$row['code'],
						  'topic'=>$row['topic'],
						  'username'=>$username);
		}
		
		echo json_encode($data);
	}
	else{
		echo "not";
	}
?>
