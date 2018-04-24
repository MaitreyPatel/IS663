
<?php include "conf.php";?>
<?php
	
	//filtering through levels, category, and topic
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$category=$response['category'];
	$level=$response['level'];
	$topic=$response['topic'];
	$res_proejct=question_project($category,$level, $topic);	
	echo $res_proejct;
function question_project($category,$level, $topic){
	$data = array('category' => $category,'level'=>$level,'topic'=> $topic);
	$url = $GLOBALS['BACK_PATH']."filterquestion_back.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	$response = curl_exec($ch);
	curl_close ($ch);
	return $response;
}
?>