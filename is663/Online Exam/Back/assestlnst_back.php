<?php
	include "db.php";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$userId=$response['userId'];
	$sql="select * from users where `id`='$userId'";
	$query=$db->query($sql);
	$res=$query->fetch();
	$auth=$res['authority'];
	$username=$res['username'];
	
	if($auth.trim(" ")=="instructor".trim(" ")){
		$sql="select * from exam where `status`='2'";
		$query=$db->query($sql);
		$res=$query->fetch();
		$exam=$res['id'];
		$count=$res['count'];
		
		$sql="select * from answer where `examId`='$exam'";
		$query = $db->query($sql);
		$result=$query->fetchAll();
		$data=[];
		foreach($result as $r){
			$id=$r['id'];
			$st=$r['stdId'];
			$q=$r['quesId'];
			$code=$r['code'];
			$output1=$r['output1'];
			$output2=$r['output2'];
			$output3=$r['output3'];
			$output4=$r['output4'];
			$ass=$r['assest'];
			$point=$r['point'];
			$feedback=$r['feedback'];
			
			$sql="select * from question where `id`='$q'";
			$query = $db->query($sql);
			$res=$query->fetch();
			$sample1=$res['output1'];
			$sample2=$res['output2'];
			$sample3=$res['output3'];
			$sample4=$res['output4'];
			
			$sql="select * from users where `id`='$st'";
			$query=$db->query($sql);
			$res=$query->fetch();
			$name=$res['username'];
			
			$data[]=array("id"=>$id,
						"name"=>$name,
						"stdId"=>$st,
						"quesId"=>$q,
						"code"=>$code,
						"output1"=>$output1,
						"output2"=>$output2,
						"output3"=>$output3,
						"output4"=>$output4,
						"sample1"=>$sample1,
						"sample2"=>$sample2,
						"sample3"=>$sample3,
						"sample4"=>$sample4,
						"point"=>$point,
						"assest"=>$ass,
						"feedback"=>$feedback,
						"username"=>$username,
						"count"=>$count);
		}
		echo json_encode($data);
	}
	else{
		echo "not";
	}
?>