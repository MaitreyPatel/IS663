<html lang="en">
<?php include "sessions/instructor_user.php";?>
<?php include "logout.php";?>
<head>
<title>Instructor Page</title>
<meta charset="utf-8">
<link href="instructor_front.css" rel="stylesheet" type="text/css">
<script src="js/scripts.js" type="text/JavaScript"></script>
<script src="instructor_front.js" type="text/JavaScript"></script>


	<div class="menu">
		<ul>
      <b>
			<li><a href="instructor_front.php">Home</a></li>
			<li><a href="editExam.php">Create Test</a></li>
			<li><a href="question_bank.php">Modify Questions</a></li>
			<li><a href="assest.php">Review Tests</a></li>
			
      <div class="logout">
				<li><a href="#" onclick="logout()">Log out</a></li>
      </div>
      <b>
		</ul>
  </div>
</head>
<body>
<div id="user"></div>
<h2><center>Instructor Page</center></h2>

<div id="ajaxDiv"></div>
</body>
</html>