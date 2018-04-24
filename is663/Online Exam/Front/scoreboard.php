<html lang="en">
<?php include "conf.php";?>
<?php include "sessions/student_user.php";?>
<?php include "logout.php";?>
<head>
<title>Student page</title>
<meta charset="utf-8">
<link href="scoreboard.css" rel="stylesheet" type="text/css">
<script src="scoreboard.js" type="text/JavaScript"></script>
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
<h2><center>Score Board</center></h2>


<div id="ajaxDiv"></div>
</body>
</html>