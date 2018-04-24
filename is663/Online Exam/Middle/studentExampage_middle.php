
<?php include "conf.php";?>
<?php
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); 
	$studentId=$response['userid'];
	
	$res_proejct=question_project($studentId);	
	echo $res_proejct;
function question_project($studentId){
	$data = array('studentId'=>$studentId);
	$url = $GLOBALS['BACK_PATH']."studentExampage_back.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	$response = curl_exec($ch);
	curl_close ($ch);
	return $response;
}
?>
