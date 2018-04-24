<?php
include "db.php";
$str_json = file_get_contents('php://input'); 
$response = json_decode($str_json, true);

$code = $response['code'];
$studentId = $response['stdId'];
$qid = $response['quesId'];
$resp = "";

for($i=1;$i<5;$i++){
    $sql = "";
    // FIX
    $output = str_replace("'", "\'", $response['output'.$i]);
    if($response['isError'.$i]){
        $sql="update `answer` set `code`='$code' ,`feedback`='$output' where `stdId`='$studentId' and `quesId`='$qid'";
    } else {
        $outId = "output".$i;
        $sql="update `answer` set `code`='$code' ,`$outId`='$output' where `stdId`='$studentId' and `quesId`='$qid'";        
    }
    if($query=$db->query($sql)){
        $resp .="success: ".$sql."\r\n";
    } else {
        $resp .="failure: ".$sql."\r\n";
    }
}

echo $resp;
?>