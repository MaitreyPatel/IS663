<html lang="en">
<?php include "sessions/instructor_user.php";?>
<?php include "logout.php";?>

<head>
<title>Instructor Page</title>
<meta charset="utf-8">
<link href="editExam.css" rel="stylesheet" type="text/css">
<script src="js/scripts.js" type="text/JavaScript"></script>
<script src="editExam.js" type="text/Javascript"></script>


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
	<div id="main-content">
	<div id="user">
	</div>
	<div name="editExamTable" id="editExamTable">
	<div class="row">
	<div class="col-md-3">
			<text style="font-size:1.4em; font-weight:bold;"><center>Make exam</center></text>
	</div>
	<div class="col-md-4">
			<label>Enter title of exam</label>
			<input type="text" name="eName" id="eName">
	
			<label>Category
					<select name="qCategory" id="qCategory" onchange="filterQuestion();">
						<option value="all">All</option>
						<option value="for">For</option>
						<option value="while">While</option>
						<option value="method">Method</option>
            <option value="condition">Condition</option>                                      
					</select>
				</label>
	
			<label>Difficulty level
					<select name="qLevel" id="qLevel" onchange="filterQuestion();">
						<option value="all">All</option>
						<option value="easy">Easy</option>
						<option value="medium">Medium</option>
						<option value="hard">Hard</option>
					</select>
			</label>
			<label>Topic
					<select name="topic" id="topic" onchange="filterQuestion();">
						<option value="all">All</option>
						<option value="CS100">CS100</option>
					</select>
			</label>
	</div>
</div>
<br>

			<div style="display: block;" class="questionsbank">
					<div class="panel-heading">
						<h4 style="padding-left:10%;">Question Bank</h4>
					</div>
					<div id="questions"><div><div><table class="table table-striped"><thead style="background-color:#42ABCA;"><tr><th>Check</th><th>Question</th><th>Category</th><th>Difficulty</th><th>Description</th></tr></thead><tbody><tr id="trr1"><td><input type="checkbox" id="1" value="1"></td><td><label>Addition</label></td><td>method</td><td>easy</td><td>Write a method name add that takes 2 integers parameters and returns the answer.</td></tr><tr id="trr2"><td><input type="checkbox" id="2" value="2"></td><td><label>For loop</label></td><td>for</td><td>hard</td><td>write a java program using for loop to make addition of from 1 to 5.</td></tr><tr id="trr3"><td><input type="checkbox" id="3" value="3"></td><td><label>Subtraction</label></td><td>while</td><td>medium</td><td>Write a java method that takes 2 parameters and prints the subtraction.</td></tr><tr id="trr4"><td><input type="checkbox" id="4" value="4"></td><td><label>Multiplication</label></td><td>method</td><td>medium</td><td>Write a method name multi that takes 2 integers parameters and returns their multiplication as answer.</td></tr><tr id="trr5"><td><input type="checkbox" id="5" value="5"></td><td><label>Division</label></td><td>method</td><td>medium</td><td>Write a method name div that takes 2 integers parameters and returns the division answer.</td></tr><tr id="trr6"><td><input type="checkbox" id="6" value="6"></td><td><label>Println</label></td><td>for</td><td>easy</td><td>Print out a newline saying "hello world"</td></tr></tbody></table></div></div></div>
					<div class="panel-heading1">
						<div class="addremove">
				<div class="remove/add">
						<input type="button" class="" value="<<" onclick="removeq();">
				
				
						<input type="button" class="" value=">>" onclick="addquestion();">
				</div>
		</div><h4 style="padding-left:10%;">Test</h4>
					</div>
					<div style="padding-left:10%;" id="test"><div><div><table class="table table-striped"><thead style="background-color:#42ABCA;"><tr><th>Check</th><th>Description</th><th style="width:25%;">Points</th></tr></thead><tbody><tr hidden="" id="tr1"><td><input type="checkbox" id="test1" value="1"></td><td>Write a method name add that takes 2 integers parameters and returns the answer.</td><td><input type="text" id="point1" placeholder="Input Points" style="border:none;width:100%;"></td></tr><tr hidden="" id="tr2"><td><input type="checkbox" id="test2" value="2"></td><td>write a java program using for loop to make addition of from 1 to 5.</td><td><input type="text" id="point2" placeholder="Input Points" style="border:none;width:100%;"></td></tr><tr hidden="" id="tr3"><td><input type="checkbox" id="test3" value="3"></td><td>Write a java method that takes 2 parameters and prints the subtraction.</td><td><input type="text" id="point3" placeholder="Input Points" style="border:none;width:100%;"></td></tr><tr hidden="" id="tr4"><td><input type="checkbox" id="test4" value="4"></td><td>Write a method name multi that takes 2 integers parameters and returns their multiplication as answer.</td><td><input type="text" id="point4" placeholder="Input Points" style="border:none;width:100%;"></td></tr><tr hidden="" id="tr5"><td><input type="checkbox" id="test5" value="5"></td><td>Write a method name div that takes 2 integers parameters and returns the division answer.</td><td><input type="text" id="point5" placeholder="Input Points" style="border:none;width:100%;"></td></tr><tr hidden="" id="tr6"><td><input type="checkbox" id="test6" value="6"></td><td>Print out a newline saying "hello world"</td><td><input type="text" id="point6" placeholder="Input Points" style="border:none;width:100%;"></td></tr></tbody></table></div></div></div>
		</div>
		<br>
   <br>
   <br>
    <input type="text" id="pointTracker" value="0" readonly id="overMax">
		<div class="addcancel">
				<div class="cancel/add">
						<input style="font-size: 14px; font-weight: 400; font-family: inherit;" type="submit" class="" value="Cancel" onclick="cancel();">
				
						<input style="font-size: 14px; font-weight: 400; font-family: inherit;" type="reset" value="Done" class="" onclick="examAdd();">
				</div>
		</div>
		
		
	</div>
	<div id="alert"></div>
</body>
</html>