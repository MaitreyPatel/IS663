<?php include "sessions/instructor_user.php";?>
<?php include "logout.php";?>

<head>
<title>Instructor Page</title>
<meta charset="utf-8">
<link href="assest.css" rel="stylesheet" type="text/css">
<script src="js/scripts.js" type="text/JavaScript"></script>
<script src="assest_inst.js" type="text/JavaScript"></script>
<style>
	textarea{
		width:300px;
		border:none;
	}
</style>

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
	<h3><center>Assess Exam</center></h3>
	<div align="right">
		<input style="font-size: 14px; font-weight: 400; font-family: inherit; color: #FFFFFF;" type="button" value="Release" class="" onclick="release();"/>
	</div>
	<div id="ajaxDiv"></div>
	<div class="container" id="alert"></div>
</body>