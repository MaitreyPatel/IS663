<html lang="en">
<?php include "sessions/student_user.php";?>
<?php include "logout.php";?>
<head>
<title>Student page</title>
<meta charset="utf-8">
<link href="studentExampage.css" rel="stylesheet" type="text/css">
<script src="js/scripts.js" type="text/JavaScript"></script>
<script src="studentExampage.js" type="text/JavaScript"></script>
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

<h2><center>Student Exam Page</center></h2>


<div id="ajaxDiv" style="border:3px solid #FFFFFF; margin-left: 20%; margin-right: 20%;"></div>
<br>
<br>
<div class="container" id="alert">
<input style="font-size: 14px; font-weight: 400; font-family: inherit; margin-left: 47%;" class="submit" type="button" value="Submit" onclick="assest();">
</div>
</body>
</html>