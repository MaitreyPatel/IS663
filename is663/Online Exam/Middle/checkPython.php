
<?php 
// ***** Constant VARS ***** //
$OUT_ERR = " 2>&1"; // append to a end of a command to output errors
$NL = "\r\n";  // append to end of echo text to output 'newline'





// ***** Calculating the Grade ***** //
function calculateGrade($mainFileContents, $testingFileContents, $input){
	global $OUT_ERR, $NL;

	// ***** Calculated VARS ***** //
	$mainFile = "main.py";
	$testFileNoExt = "testing";
	$testingFile = $testFileNoExt.".py";
	$finalNotes = "";


	// ***** Creating the files ***** //
	$openedMain = fopen("/tmp/".$mainFile, 'w');
	fwrite($openedMain, $testingFileContents.$NL.$mainFileContents);

	
	// ***** Excecuting the complied files ***** //
	$runCommand = "python /tmp/".$mainFile." ".$input.$OUT_ERR;
	$goodmsg = "";
	$contents = array();
	$noError = true;

	exec($runCommand, $contents);
	foreach($contents as &$content){
		$goodmsg.=$content.$NL;
		if(explode(" ", $goodmsg)[0] === "Traceback"){
			$noError = false;
		}
	}
	$goodmsg = trim($goodmsg, $NL);
	return array($noError, $goodmsg);
}
?>
