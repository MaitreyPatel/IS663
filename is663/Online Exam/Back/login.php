<?php
	include "db.php";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$name="none";$pass="none";
	if(isset($response['name'])) $name = $response['name'];
	if(isset($response['pass'])) $pass = $response['pass'];
	$sql="select * from users where  `username` like '$name' and `password` like '$pass'";
	$query = $db->query($sql);
	$result=$query->fetch();
//	if($result) echo "Student";//$result[0]['kind']; //student else instructor
//	else echo "Reject";
	if($result){
		$data=array("username"=>$result['username'],
					"authority"=>$result['authority'],
					"userid"=>$result['id']);
	}
	else{
		$data=array("username"=>"none","authority"=>"none","userid"=>"none");
	}
	echo json_encode($data);
//	echo $data;
