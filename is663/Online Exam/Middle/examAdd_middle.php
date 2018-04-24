
<?php include "conf.php";?>
<?php
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$name=$response['name'];
	if(isset($response['questions'])) $questions = $response['questions'];
	if(isset($response['points'])) $points=$response['points'];
	
	$res_proejct=question_project($name,$questions,$points);	
	echo $res_proejct;
function question_project($name,$questions,$points){
	
	$data = array('name'=>$name,'questions' => $questions,'points'=>$points);
	$url = $GLOBALS['BACK_PATH']."examAdd_back.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	$response = curl_exec($ch);
	curl_close ($ch);
	return $response;
}
?>