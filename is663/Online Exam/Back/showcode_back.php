<?php
	include "db.php";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$userId=$response['userId'];
	$id=$response['id'];
	$sql="select * from users where `id`='$userId'";
	$query=$db->query($sql);
	$res=$query->fetch();
	$auth=$res['authority'];
	$username=$res['username'];
	
	if($auth.trim(" ")=="instructor".trim(" ")){
		$sql="select * from answer where `id`='$id'";
		$query = $db->query($sql);
		$result=$query->fetch();
		$data=array("code"=>$result['code'],
					"output1"=>$result['output1'],
					"output2"=>$result['output2'],
					"output3"=>$result['output3'],
					"output4"=>$result['output4'],
					);
		echo json_encode($data);
	}
	else{
		echo "not";
	}
?>