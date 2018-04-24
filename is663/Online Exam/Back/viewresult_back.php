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

		$sql="select * from answer where status='released' and examId='$examId' and stdId='$userId'";
		$query = $db->query($sql);
		$result=$query->fetchAll();
		$data=[];
		foreach($result as $r){
			$id=$r['id'];
			$q=$r['quesId'];
			$code=$r['code'];
			$output1=$r['output1'];
			$output2=$r['output2'];
			$output3=$r['output3'];
			$output4=$r['output4'];
			$point=$r['point'];
			$ass=$r['assest'];
			$feedback=$r['feedback'];
			
			$sql="select * from question where `id`='$q'";
			$query=$db->query($sql);
			$res=$query->fetch();
			$question=$res['description'];
			$sample1=$res['output1'];
			$sample2=$res['output2'];
			$sample3=$res['output3'];
			$sample4=$res['output4'];
			
			$data[]=array("id"=>$id,
						"question"=>$question,
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