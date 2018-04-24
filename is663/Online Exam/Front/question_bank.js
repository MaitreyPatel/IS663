serviceCall({request:"editQuestions"}, function(res) {
	var question_list=document.getElementById("question_list");		
	var ajaxDisplay = document.getElementById('ajaxDiv');
	var tas = document.querySelectorAll("textarea")
	for(var i=0; i<tas.length; i++){
		var ta = tas[i];
		ta.addEventListener('keydown',function(e) {
			if(e.keyCode === 9) { // tab was pressed
				// get caret position/selection
				var start = this.selectionStart;
				var end = this.selectionEnd;
		
				var target = e.target;
				var value = target.value;
		
				// set textarea value to: text before caret + tab + text after caret
				target.value = value.substring(0, start)
							+ "\t"
							+ value.substring(end);
		
				// put caret at right position again (add one for the tab)
				this.selectionStart = this.selectionEnd = start + 1;
		
				// prevent the focus lose
				e.preventDefault();
			}
		},false);
	}
	if(res.trim()=="not".trim()){
	//	alert("you are not an Instructor");
	//	window.location.replace("login.php");
		document.write("This page is blocked for you.");
	}
	else{
		var data=JSON.parse(res);
		var len=data.length;
		console.log(res);
		for(var i=0;i<len;i++){
			var option=new Option(data[i]['name'],data[i]['id']);
			question_list.add(option,i+1);
		}
	}
});

function viewQuestion(){
	var id=document.getElementById("question_list").value;
	serviceCall({request:"viewQuestions", data:{"id":id}}, function(res) {
			var question_list=document.getElementById("question_list");
			var ajaxDisplay = document.getElementById('ajaxDiv');
			var data=JSON.parse(res);
			document.getElementById("qID").value=data[0]['id'];
			document.getElementById("qDescript").value=data[0]['description'];
			document.getElementById("qCode").value=data[0]['code'];
			document.getElementById("template").value=data[0]['template'];
			document.getElementById("input1").value=data[0]['input1'];
			document.getElementById("output1").value=data[0]['output1'];
			document.getElementById("input2").value=data[0]['input2'];
			document.getElementById("output2").value=data[0]['output2'];
			document.getElementById("input3").value=data[0]['input3'];
			document.getElementById("output3").value=data[0]['output3'];
			document.getElementById("input4").value=data[0]['input4'];
			document.getElementById("output4").value=data[0]['output4'];
			document.getElementById("qName").value=data[0]['name'];
			document.getElementById("qCategory").value=data[0]['category'];
			document.getElementById("qLevel").value=data[0]['level'];
			// 10/13 ADDED FOR TOPIC
			document.getElementById("topic").value=data[0]['topic'];
	});

}
function newQuestion(){
	document.getElementById("question_list").value='';
	document.getElementById("qID").value='';
	document.getElementById("qDescript").value='';
	document.getElementById("qCode").value='';
	document.getElementById("template").value='';
	document.getElementById("input1").value='';
	document.getElementById("output1").value='';
	document.getElementById("input2").value='';
	document.getElementById("output2").value='';
	document.getElementById("input3").value='';
	document.getElementById("output3").value='';
	document.getElementById("input4").value=''
	document.getElementById("output4").value='';
	document.getElementById("qName").value='';
	document.getElementById("qCategory").value='';
	document.getElementById("qLevel").value='';
	// 10/13 ADDED FOR TOPIC
	document.getElementById("topic").value='';
}
function addQuestion(){

	var id=document.getElementById("qID").value;
	var description=document.getElementById("qDescript").value;
	var name=document.getElementById("qName").value;
	var level=document.getElementById("qLevel").value;
	var category=document.getElementById("qCategory").value;
	var code=document.getElementById("qCode").value;
	var template=document.getElementById("template").value;
	var input1=document.getElementById("input1").value;
	var output1=document.getElementById("output1").value;
	var input2=document.getElementById("input2").value;
	var output2=document.getElementById("output2").value;
	var input3=document.getElementById("input3").value;
	var output3=document.getElementById("output3").value;
	var input4=document.getElementById("input4").value;
	var output4=document.getElementById("output4").value;
	var topic=document.getElementById("topic").value;

	if(name=='' || level==''){
		var alt = document.getElementById('alert');
		html='<center><h3 style="font-size: 18px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">'+''+'</h3></center>';
		alt.innerHTML=html;
	}
	else{

		serviceCall({request:"addQuestion", data:{"id":id,"name":name,"description":description,"level":level,"category":category,"code":code,"template":template,"input1":input1,"output1":output1,"input2":input2,"output2":output2,"input3":input3,"output3":output3,"input4":input4,"output4":output4,"topic":topic}}, function(res) {
			var question_list=document.getElementById("question_list");
			var alt = document.getElementById('alert');
			html='<center><h3 style="font-size: 24px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">'+res+'</h3></center>';
			alt.innerHTML=html;
		});
	}
}