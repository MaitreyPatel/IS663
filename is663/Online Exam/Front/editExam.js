var L;
var NAME=[];
var NAME1=[];
var pt=[]; 

serviceCall({request:"editExam"}, function(res) {
	var ajaxDisplay = document.getElementById('questions');
	var testDisplay=document.getElementById('test');
	if(res.trim()=="not".trim()){
		document.write("This page is blocked for you.");
	}
	else{
		var data=JSON.parse(res);
		var html="<div>";
		html+="<div>";
		html+="<table class='table table-striped'>";
		html+="<thead style='background-color:#42ABCA;'><tr><th>Check</th>";
		html+="<th>Question</th>";
		html+="<th>Category</th>";
		html+="<th>Difficulty</th>";
    html+="<th>Topic</th>";
		html+="<th>Description</th>";
		html+="</tr></thead>";
		html+="<tbody>";
		var testHtml="<div>";
		testHtml+="<div>";
		testHtml+="<table class='table table-striped'>";
		testHtml+="<thead style='background-color:#42ABCA;'><tr><th>Check</th>";
		testHtml+="<th>Description</th>";
		testHtml+="<th style='width:25%;'>Points</th></tr>"
		testHtml+='</thead><tbody>';
		var len=data.length;
		L=len;
		for(var i=0;i<len;i++){
			NAME.push(data[i]['id']);
			NAME1.push("test"+data[i]['id']);
			pt.push("point"+data[i]['id']);
			html+='<tr id="'+'trr'+data[i]['id']+'"><td>';
			html+='<input type="checkbox" id="'+data[i]['id'];
			html+='" value="'+data[i]['id']+'"'+'></td>';
			html+='<td><label>'+data[i]['name']+'</label></td>';
			html+='<td>'+data[i]['category']+'</td>';
			html+='<td>'+data[i]['level']+'</td>';
      html+='<td>'+data[i]['topic']+'</td>';
			html+='<td>'+data[i]['description']+'</td>';
			html+='</tr>';
			testHtml+="<tr hidden id='"+"tr"+data[i]['id']+"'><td>";
			testHtml+='<input type="checkbox" id="'+"test"+data[i]['id'];
			testHtml+='" value="'+data[i]['id']+'"'+'></td>';
			testHtml+='<td>'+data[i]['description']+'</td>';
			testHtml+='<td><input type="text"';
			testHtml+='id="'+pt[i]+'"';
			/*testHtml+='placeholder="Input Points" style="border:none;width:100%;"/></td>';*/
      testHtml+='placeholder="Input Points" class="thePoints" onkeyup="checkPoints()" style="border:none;width:100%;"/></td>';
			testHtml+='</tr>';
		}
		html+="</tbody></table>";
		html+="</div></div>";
		testHtml+="</tbody></table>";
		testHtml+='</div></div>';
		ajaxDisplay.innerHTML=html;
		testDisplay.innerHTML=testHtml;
	}
});

function cancel(){
	var questions="";
	var started=0;
	for(var i=0;i<L;i++){
		document.getElementById(pt[i]).value='';
		var chkbox=document.getElementById(NAME[i]);
		chkbox.checked=false;
		document.getElementById(NAME1[i]).checked=false;
		document.getElementById('tr'+NAME[i]).hidden=true;
		
	}
}
function examAdd(){
	var name=document.getElementById("eName").value;
	var questions="";
	var points="";
	var started=0;
	var po=false;
  var pointSum = 0;
	for(var i=0;i<L;i++){
		var chkbox=document.getElementById(NAME[i]);
		var p=document.getElementById(pt[i]).value;
    if(parseInt(p)){
			pointSum+=parseInt(p);
		}
		if(chkbox.checked){
			if(p=='') po=true;
			else{
				if(!Number(p)) po=true;
			}
			if(started==0){
				questions+=NAME[i];
				points+=p;
			}
			else{
				questions+=" "+NAME[i];
				points+=" "+p;
			}
			started=1;
		}
	}
	if(name==''){
		var alt=document.getElementById('alert');
		var html='<center><h3 style="font-size: 24px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">'+'You must input Exam Title'+'</h3></center>';
		alt.innerHTML=html;
	}
	else if(po==true){
		var alt=document.getElementById('alert');
		var html='<center><h3 style="font-size: 24px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">'+'You must input Points(It should be number)'+'</h3></center>';
		alt.innerHTML=html;
	}
  else if(pointSum >100){
		var alt=document.getElementById('alert');
		var html='<center><h3 style="font-size: 24px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">'+'The maximum number of points cannot exceed 100'+'</h3></center>';
		alt.innerHTML=html;
	}
	else{
		serviceCall({request:"addExam", "data":{"name":name,"questions":questions,"points":points}}, function(res) {
			var ajaxDisplay = document.getElementById('ajaxDiv');
			var alt=document.getElementById('alert');
			var html='<center><h3>'+res+'</h3></center>';
			alt.innerHTML=html;
		});
	}
}
function addquestion(){
	for(var i=0;i<L;i++){
		var chkbox=document.getElementById(NAME[i]);
		if(chkbox.checked){
			document.getElementById('tr'+NAME[i]).hidden=false;
		}
	}
}
function removeq(){
	for(var i=0;i<L;i++){
		var chkbox=document.getElementById(NAME1[i]);
		if(chkbox.checked){
			document.getElementById('tr'+NAME[i]).hidden=true;
			document.getElementById(NAME[i]).checked=false;
			chkbox.checked=false;
		}
	}
}

function filterQuestion(){
	var category=document.getElementById("qCategory").value;
	var level=document.getElementById("qLevel").value;
  var topic=document.getElementById("topic").value;
	serviceCall({request:"filterQuestion", "data":{"category":category,"level":level,"topic":topic}}, function(res) {
		var ajaxDisplay = document.getElementById('ajaxDiv');
		var data=JSON.parse(res);
		if(data.length==0){
			for(var i=0;i<L;i++){
				document.getElementById('trr'+NAME[i]).hidden=true;
				document.getElementById(NAME[i]).checked=false;
			}
		}
		else{
			for(var i=0;i<L;i++){
				var filter=0;
				for(var j=0;j<data.length;j++){
					if(NAME[i]==data[j]['id']){
						filter=1;
						break;
					}
				}
				if(filter==0){
					document.getElementById('trr'+NAME[i]).hidden=true;
					document.getElementById(NAME[i]).checked=false;
				}
				else{
					document.getElementById('trr'+NAME[i]).hidden=false;
					document.getElementById(NAME[i]).checked=false;
				}
			}
		} 
	});
}
function setupLeftNav(){
	var leftNavItems = document.getElementById("left-nav").getElementsByTagName("li");
	Array.from(leftNavItems).forEach( function(el){ el.onclick = leftNavItemClick; });
  }
  
function leftNavItemClick() {
	var leftNavItems = document.getElementById("left-nav").getElementsByTagName("li");
	Array.from(leftNavItems).forEach( function(el){
	  el.classList.remove("selected");
	});
	this.classList.add("selected");
 }

function checkPoints(){
	var points = document.getElementsByClassName("thePoints");
	var pointsSum=0;
	for(var i=0; i<points.length; i++){
		var p = points[i].value;
		if(parseInt(p)){
			pointsSum+=parseInt(p);
		}
	}
	document.getElementById("pointTracker").value=pointsSum;
	if(pointsSum>100){
		document.getElementById("pointTracker").classList.add("overMax");
	} else {
		document.getElementById("pointTracker").classList.remove("overMax");
	}
}