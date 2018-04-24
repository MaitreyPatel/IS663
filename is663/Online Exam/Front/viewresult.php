<html lang="en">
<?php include "conf.php";?>
<?php include "sessions/student_user.php";?>
<?php include "logout.php";?>
<head>
<title>Student page</title>
<meta charset="utf-8">
<link href="viewresult.css" rel="stylesheet" type="text/css">
<script src="viewresult.js" type="text/JavaScript"></script>
<script src="js/scripts.js"></script>
<link href="css/onlineexam.css" rel="stylesheet">



	<div class="menu">
		<ul>
      <b>
			<li><a href="student_front.php">Home</a></li>
			<li><a href="studentExampage.php">Take Test</a></li>
			<li><a href="viewresult.php">Detailed Results</a></li>
			<li><a href="scoreboard.php">Test Scores</a></li>
			
      <div class="logout">
				<li><a href="#" onclick="logout()">Log out</a></li>
      </div>
      <b>
		</ul>
  </div>
</head>
<body>
<h2><center>My Exam Result</center></h2>


<div style="border:3px solid #FFFFFF; margin-left: 20%; margin-right: 20%;" id="ajaxDiv"></div>
</body>
</html>