
<?php
    include "conf.php";
    
    $url = $GLOBALS['BACK_PATH']."getProfCode.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('qid'=>$stdCode['id'])) );
    $val = curl_exec($ch);
    $retRes += $val;
    $res = json_decode($val, true);
    curl_close ($ch);
    
?>