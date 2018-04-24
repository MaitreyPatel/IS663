<?php
	include "db.php";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$userId=$response['userId'];
	$sql="select * from users where `id`='$userId'";
	$query=$db->query($sql);
	$result=$query->fetch();
	$auth=$result['authority'];
	$username=$result['username'];
	if($auth.trim(" ")=="student".trim(" ")){
		$sql="select * from exam where `status`=2";
		$query=$db->query($sql);
		$result=$query->fetch();
		$examId=$result['id'];
		$count=$result['count'];
		$exam=$result['name'];
		
		$sql="select * from answer where `status`='released' and `examId`='$examId'";
		$query = $db->query($sql);
		$result=$query->fetchAll();
		$data=[];
		foreach($result as $r){
			$id=$r['id'];
			$st=$r['stdId'];
			$q=$r['quesId'];
			$code=$r['code'];
			$point=$r['point'];
			$ass=$r['assest'];
			$feedback=$r['feedback'];
			
			$sql="select * from users where `id`='$st'";
			$query=$db->query($sql);
			$res=$query->fetch();
			$name=$res['username'];
			
			$data[]=array("id"=>$id,
						"name"=>$name,
						"stdId"=>$st,
						"quesId"=>$q,
						"code"=>$code,
						"point"=>$point,
						"assest"=>$ass,
						"feedback"=>$feedback,
						"count"=>$count,
						"exam"=>'Exam',
						"username"=>$username);
				//		"exam"=>$exam);
		}
		echo json_encode($data);
	}
	else{
		echo "not";
	}
?>