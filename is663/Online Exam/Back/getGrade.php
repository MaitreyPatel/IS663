<?php 
// ***** CONSTANT VARS ***** //
$OUT_ERR = " 2>&1"; // append to a end of a command to output errors
$NL = "\r\n";  // append to end of echo text to output 'newline'


// ***** OUTPUTS THE CURRENT USER (DAEMON IF FROM BROWSER)  ***** //
//exec('whoami', $userLoggedIn);
//echo "user: ".$userLoggedIn[0];


// ***** TESTING ONLY ***** //
/*
	// ***** USER DEFINED VARS ***** //
	$mainFileContents = 'public class Main{ public static void main(String[] args){ int a = Integer.parseInt(args[0]); int b =
	Integer.parseInt(args[1]); MathOps mo = new MathOps();  System.out.println(mo.add(a,b)); } }';
	$testingFileContents = 'public class MathOps { public int add(int a,int b){ return a+b; } }';
	$inputOutputObject = "8 2";
	print_r( calculateGrade($mainFileContents, $testingFileContents, $inputOutputObject) );
*/


// ***** CALCULATE GRADE ***** //
function calculateGrade($mainFileContents, $testingFileContents, $input){
	global $OUT_ERR, $NL;

	// ***** CALCULATED VARS ***** //
	$mainClassName = explode(" ", explode("{", explode("class ", $mainFileContents)[1])[0])[0];
	$testingClassName = explode(" ", explode("{", explode("class ", $testingFileContents)[1])[0])[0];
	$mainFile = $mainClassName.".java";
	$testingFile = $testingClassName.".java";
	$finalNotes = "";


	// ***** VALIDATION ***** //
	if( strlen($mainClassName) === 0){
		return array(false, "Could not find the class name in the Professors code.");
	}
	if(strlen($testingClassName) === 0){
		//TODO Notify user that class names could not be determined;
		return array(false,"Could not find the class name in the Students code.");
	}


	// ***** CREATE FILES ***** //
	$openedMain = fopen("/tmp/".$mainFile, 'w');
	fwrite($openedMain, $mainFileContents);
	$openedTesting = fopen("/tmp/".$testingFile, 'w');
	fwrite($openedTesting, $testingFileContents);

	// ***** COMPILE FILES ***** //
	$compileTestingCommand = "/afs/cad/linux/java/bin/javac -cp /tmp /tmp/".$testingFile.$OUT_ERR;
	exec($compileTestingCommand, $err2);
	$compileMainCommand = "/afs/cad/linux/java/bin/javac -cp /tmp /tmp/".$mainFile.$OUT_ERR;
	exec($compileMainCommand, $err);
	$errmsg = "";
	  // Validate
	if(count($err) != 0) {
		foreach($err as &$er){
			$errmsg.=$er.$NL;
		}
		$finalNotes .= "The Professors code did not compile.".$NL;
	}
	if(count($err2) != 0) {
		$errmsg .= $NL;
	        foreach($err2 as &$er){
	                $errmsg.=$er.$NL;
		}
		$finalNotes .= "The Students code did not compile.".$NL;
	} 
	if(strlen($errmsg) >0){
		// TODO Can potentially notify user of compilation error
		return array(false, $finalNotes);
	}


	// ***** EXECUTE COMPILED FILES ***** //
	$runCommand = "/afs/cad/linux/java/bin/java -cp /tmp ".$mainClassName." ".$input.$OUT_ERR;
	$goodmsg = "";
	$contents = array();
	exec($runCommand, $contents);
	foreach($contents as &$content){
		$goodmsg.=$content.$NL;
	}
	$goodmsg = trim($goodmsg, $NL);
	return array(true, $goodmsg);
}
?>
