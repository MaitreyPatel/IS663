<?php ob_start();
include("conf.php");
ob_end_clean();?>
<?php 
session_start();
$str_json= file_get_contents('php://input');
$response = json_decode($str_json, true);
$data = NULL;
if( !isset($response['request']) ){
    echo "no request param set in json";
    return;
}
if( isset($response['data']) ){
    $data = $response['data'];
}


$middlePath = "https://web.njit.edu/~ps539/is663/Middleend/";
switch ($response['request']) {
    case "login":
        login();
        break;
    case "examPage":
        examPage();
        break;
    case "logout":
        logout();
        break;
    case "examResults":
        examResults();
        break;
    case "scoreboard":
        scoreboard();
        break;
    case "instructorPage":
        instructorPage();
        break;
    case "editExam":
        editExam();
        break;
    case "addExam":
        addExam();
        break;
    case "filterQuestion":
        filterQuestion();
        break;
    case "editQuestions":
        editQuestions();
        break;
    case "viewQuestions":
        viewQuestions();
        break;
    case "addQuestion":
        addQuestion();
        break;
    case "assess":
        assess();
        break;
    case "release":
        release();
        break;
    case "postAnswers":
        postAnswers();
        break;
    default:
        echo "unknown request param set in json";
        break;
}


function postAnswers(){
    global $data;
    $dataSend = array('userid'=>$_SESSION['userid'], 'answers'=>$data);
    $resp = middleCall("assest_middle.php",$dataSend);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    } 
}

function release(){
    global $data;
    $resp = middleCall("release_middle.php",$data);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    } 
}

function assess(){
    $data = array('userid'=>$_SESSION['userid'], 'authority'=>$_SESSION['authority'],'username'=>$_SESSION['username']);
    $resp = middleCall("assestInst_middle.php",$data);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    }
}


function addQuestion(){
    global $data;
    $resp = middleCall("questionadd_middle.php",$data);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    } 
}

function viewQuestions(){
    global $data;
    $resp = middleCall("questionview_middle.php",$data);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    } 
}


function editQuestions(){
    $data = array('userid'=>$_SESSION['userid'], 'authority'=>$_SESSION['authority'],'username'=>$_SESSION['username']);
    $resp = middleCall("question_middle.php",$data);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    }
}

function filterQuestion(){
    global $data;
    $resp = middleCall("filterquestion_middle.php",$data);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    } 
}

function addExam(){
    global $data;
    $resp = middleCall("examAdd_middle.php",$data);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    } 
}

function editExam(){
    $data = array('userid'=>$_SESSION['userid'], 'authority'=>$_SESSION['authority'],'username'=>$_SESSION['username']);
    $resp = middleCall("question_middle.php",$data);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    }
}

function instructorPage(){
    $data = array('userid'=>$_SESSION['userid'], 'authority'=>$_SESSION['authority'],'username'=>$_SESSION['username']);
    $resp = middleCall("inst_middle.php",$data);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    }
}

function scoreboard() {
    $data = array('userid'=>$_SESSION['userid'], 'authority'=>$_SESSION['authority'],'username'=>$_SESSION['username']);
    $resp = middleCall("scoreboard_middle.php",$data);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    }
}

function middleCall($pathName, $data){
    global $middlePath;
    $url = $middlePath.$pathName;
    
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	$response = curl_exec($ch);
    curl_close ($ch);
    return $response;
}

function examResults() {
    $data = array('userid'=>$_SESSION['userid'], 'authority'=>$_SESSION['authority'],'username'=>$_SESSION['username']);
    $resp = middleCall("viewresult_middle.php",$data);
    if($resp){
        echo $resp;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    }
}


function login(){
    global $data;
    if($data === NULL){
        echo "no 'data' param set in json";
        return;
    }

    $response = middleCall("login.php",$data);
    if($response){
        $jsonR = json_decode($response, TRUE);
        if($jsonR['username'] === "none"){
            echo json_encode( array('response'=> 'invalid credentials') );
        } else {
            $_SESSION['authority'] = $jsonR['authority'];
            $_SESSION['userid'] = $jsonR['userid'];
            $_SESSION['username'] = $jsonR['username'];
            echo json_encode( array('response'=>'successful login', 'status'=>'success') );
        }
    } else {
        echo json_encode( array('response'=>'error communicating with backend system') );
    }
}


function logout(){
    if( isset( $_SESSION['authority']) || isset($_SESSION['userid']) || isset($_SESSION['username']) ) { 
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        unset($_SESSION['authority']);
        echo "Logged out";
    } else {
        echo "Not logged in";
    }
}

function examPage() {
    global $middlePath;
    $data = array('userid'=>$_SESSION['userid'], 'authority'=>$_SESSION['authority'],'username'=>$_SESSION['username']);
    $response = middleCall("studentExampage_middle.php",$data);
    if($response){
            echo $response;
    } else {
        echo json_encode( array('response'=>'error communicating with backend system', 'status'=>'error') );
    }
}

?>
