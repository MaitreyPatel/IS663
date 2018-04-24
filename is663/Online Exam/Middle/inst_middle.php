
<?php include "conf.php";
?>

<?php
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$userId=$response['userid'];
	$res_project=login_project($userId);	
	echo $res_project;
function login_project($userId){
	$data = array('userId' => $userId);
	$url = $GLOBALS['BACK_PATH']."inst_back.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	$response = curl_exec($ch);
	curl_close ($ch);
	return $response;
}
function login_njit($name,$pass){
	$url = "https://cp4.njit.edu/cp/home/login";
	$data= array("user" => $name,"pass" =>$pass,"uuid" => "0xACA021");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));  
	$response = curl_exec($ch);
	curl_close ($ch);
	
	if (strpos($response,"Error: Failed Login")==false) return "NJIT Accept";
	return  "NJIT Reject";
}
