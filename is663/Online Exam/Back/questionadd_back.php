<?php
	include "db.php";

	// 10/13 ADDED TOPIC

	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$id=$response['id'];
	if(isset($response['name'])) $name = $response['name'];
	if(isset($response['level'])) $level = $response['level'];
	if(isset($response['description'])) $description = $response['description'];
	if(isset($response['category'])) $category=$response['category'];
	if(isset($response['code'])) $code=$response['code'];
	$template=$response['template'];
	$input1=$response['input1'];
	$output1=$response['output1'];
	$input2=$response['input2'];
	$output2=$response['output2'];
	$input3=$response['input3'];
	$output3=$response['output3'];
	$input4=$response['input4'];
	$output4=$response['output4'];
	$topic = $response['topic'];
	if($id==''){
		$sql="insert into `question` (`name`,`description`,`level`,`category`,`code`,`template`,`input1`,`output1`,`input2`,`output2`,`input3`,`output3`,`input4`,`output4`, `topic`)VALUES ('$name','$description','$level','$category','$code','$template','$input1','$output1','$input2','$output2','$input3','$output3','$input4','$output4', '$topic')";
		$query = $db->query($sql);
		if($query) echo 'Question is added successfuly.';
		else echo "Question addtion is failed.";
	}
	else{
		$sql="update `question` set `name`='$name', `description`='$description',`level`='$level', `category`='$category', `code`='$code',`template`='$template',`input1`='$input1', `output1`='$output1', `input2`='$input2', `output2`='$output2', `input3`='$input3', `output3`='$output3', `input4`='$input4', `output4`='$output4', `topic`='$topic' where `id`='$id'";
		$query=$db->query($sql);
		if($query) echo "Question modification is done successfuly";
		else echo "Question modification is failed";
	}
?>