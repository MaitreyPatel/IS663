<html lang="en">
<?php include "sessions/instructor_user.php";?>
<?php include "logout.php";?>
<head>
<title>Instructor Page</title>
<meta charset="utf-8">
<link href="question_bank.css" rel="stylesheet" type="text/css">
<script src="js/scripts.js" type="text/JavaScript"></script>
<script src="question_bank.js" type="text/JavaScript"></script>


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
<center>
	<h2>Make New Questions or Modify Existing Questions</h2>

	<br><br>
	<div class="row">
		<div class="make_question">
			<label>Questions</label>
			<select id="question_list" name="question_list" width="50px" onchange="viewQuestion();">
				<option></option>
			</select>

			<input type="hidden" name="qID" id="qID">
			<label>Question Name
			<input type="text" name="qName" id="qName" placeholder="Question Name"/>
			</label>
		
			<label>Category
				<select name="qCategory" id="qCategory">
					<option></option>
					<option value="for">For</option>
					<option value="while">While</option>
					<option value="method">Method</option>
          <option value="condition">Condition</option>        
				</select>
			</label>
		
			<label>Difficulty level
				<select name="qLevel" id="qLevel">
					<option></option>
					<option value="easy">Easy</option>
					<option value="medium">Medium</option>
					<option value="hard">Hard</option>
				</select>
			</label>
      <label>Topic
				<select name="topic" id="topic">
					<option></option>
					<option value="CS100">CS100</option>
				</select>
			</label>
		</div>
  </div>

	<br><br>

	<div class="row1">
		
		<labels>Question Description</labels>
		<label1>Main Code</label1>
		<label2>Template Code</label2>
		
	
		<div class="textarea">
		<textarea style="width:400px; height:200px;"name="qDescript" id="qDescript" placeholder="Question Description"></textarea>
		
		
		<textarea  style="width:400px; height:200px;"name="qCode" id="qCode" placeholder="Main Code"></textarea>
		
			
			<textarea  style="width:400px; height:200px;"name="template" id="template" placeholder="Template Code"></textarea>
		</div>
	</div>

	<br><br>

	<div>
	<div>
		<div>	
			<table>
				<thead style="background:#d9edf7;">
					<tr>
						<th>Test Cases</th>
						<th>Answers</th>
					</tr>
				<thead>
				<tbody>
					<tr>
						<td><input type="text" placeholder="TestCase1" id="input1"></td>	
						<td><input type="text" placeholder="Answer1" id="output1"></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="TestCase2" id="input2"></td>
						<td><input type="text" placeholder="Answer2" id="output2"></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="TestCase3" id="input3"></td>
						<td><input type="text" placeholder="Answer3" id="output3"></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="TestCase4" id="input4"></td>
						<td><input type="text" placeholder="Answer4" id="output4"></td>
					</tr>     
				</tbody>
			</table>
		</div><br>
	</div>
	</div>
	<br>

	<div class="add_new">
		
			<input style="font-size: 14px; font-weight: 400; font-family: inherit;" type="button" class="" value="New" onclick="newQuestion();"></input>
			<input style="font-size: 14px; font-weight: 400; font-family: inherit;" type="submit" class="" value="Add" onclick="addQuestion();"></input>
		
	</div>
</center>
<div id="ajaxDiv"></div>
<div id="alert"></div>
</body>
</html>