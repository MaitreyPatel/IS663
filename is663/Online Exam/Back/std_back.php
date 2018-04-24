<?php
	include "db.php";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$id="none";
	if(isset($response['userId'])) $id = $response['userId'];
	$sql="select * from users where  `id`='$id'";
	$query = $db->query($sql);
	$result=$query->fetch();
	$auth=$result['authority'];
	if($auth.trim(" ")=="student".trim(" ")){
		if($result){
			$data=array("username"=>$result['username'],
						"authority"=>$result['authority'],
						"userid"=>$result['id']);
		}
		else{
			$data=array("username"=>"none","authority"=>"none","userid"=>"none");
		}
		echo json_encode($data);
	}
	else{
		echo "not";
	}
//	echo $data;