
<html lang="en">
<?php include "sessions/student_user.php";?>
<?php include "logout.php";?>
<head>
<title>Student page</title>
<meta charset="utf-8">
<link href="student_front.css" rel="stylesheet" type="text/css">


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
<h2><center>Student Page</center></h2>
<h3><center>Click began when ready to take the exam</center></h3>
<div class="began_button">
<form>
    <input style="font-size: 14px; font-weight: 400; font-family: inherit;" type="button" value="Begin"  onclick="window.location.href='http://web.njit.edu/~mp458/is663/studentExampage.php'" />
</form>
</div>
<div id="ajaxDiv"></div>
</body>
</html>