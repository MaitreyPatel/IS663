<?php
	include "db.php";
	include "getGrade.php";

	// 10/13 added, getGrade.php :: which, has a function that takes in a main class, a secondary class, and input and notifies user of output.


	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$studentId=$response['studentId'];
	$answers=$response['answers'];

	/*
	// FOR LOGGING
	$testing = $answers[0]['id'].$answers[0]['ans'];
	$resp = 'studentID:'.$studentId.' testing:'.$testing;
	$sql="insert into logs VALUES('$resp')";
	$query=$db->query($sql);
	*/

	$mode=1;
	foreach($answers as $r){
		$ans=$r['ans'];
		$qid=$r['id'];
		
		$sql="select * from question where `id`='$qid'";
		$query=$db->query($sql);
		$res=$query->fetch();
		$main=$res['code'];

		for($i=1;$i<5;$i++){
			$input=$res['input'.$i];

			$result = calculateGrade($main, $ans, $input);
			$output = $result[1];
			$sql="";

			// result[0]==true means the code compiled and ran successfully.
			if($result[0]){
				$s='output'.$i;
				$sql="update `answer` set `code`='$ans' ,`$s`='$output' where `stdId`='$studentId' and `quesId`='$qid'";
			} else {
				$sql="update `answer` set `code`='$ans' ,`feedback`='$output' where `stdId`='$studentId' and `quesId`='$qid'";
			}
			$query = $db->query($sql);
		}
		if($query) echo "submit success";
		else echo "fail";
	}
	//mark that student has submitted once
	$sql="select * from exam where `status` = '2'";
	$query = $db->query($sql);
	$result=$query->fetch();
	$exam=$result['id'];
	$exam=$exam.trim(" ");
	$exam=$exam."end";
	$sql="update `users` set `current_exam`='$exam' where `id` = '$studentId'";
	$query = $db->query($sql);
?>