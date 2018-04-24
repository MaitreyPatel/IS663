
<?php
	include "conf.php";
	include "checkPython.php";
	$str_json = file_get_contents('php://input'); 
	$response = json_decode($str_json, true); // decoding received JSON to array
	$studentId=$response['userid'];
	$stdCodes = $response['answers'];

	// It is looping through each question.
	foreach($stdCodes as $stdCode){
		// Getting the professor's code
		$url = $GLOBALS['BACK_PATH']."getProfCode.php";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('qid'=>$stdCode['id'])) );
		$val = curl_exec($ch);
		$res = json_decode($val, true);
		curl_close ($ch);

		$profCode = $res['profCode'];
		$returnArr = array('code'=>$stdCode['ans'], 'stdId'=>$studentId, 'quesId'=>$stdCode['id']);

		for($i=1;$i<5;$i++){
			$input = $res['i'.$i];

			// Exceuting the code
			$calcRes = calculateGrade($profCode, $stdCode['ans'], $input);

			$returnArr['output'.$i] = $calcRes[1];

			if($calcRes[0]){
				$returnArr['isError'.$i]=false;
			} else {
				
				$returnArr['isError'.$i]=true;
			}
		}

		// Updating the Backend DB
		$url = $GLOBALS['BACK_PATH']."updateResults.php";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($returnArr));
		$val = curl_exec($ch);
		$res = json_decode($val, true);
		curl_close ($ch);
	}

	

	
	echo "submit success";
?>