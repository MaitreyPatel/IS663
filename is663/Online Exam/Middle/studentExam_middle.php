
<?php include "conf.php";
	session_start();
?>
<?php
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$res_proejct=question_project();
	echo $res_proejct;
function question_project(){
	$data = array('level' => "none");
	$url = $GLOBALS['BACK_PATH']."studentExam_back.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	$response = curl_exec($ch);
	curl_close ($ch);
	return $response;
}
?>
