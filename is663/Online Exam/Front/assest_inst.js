

var L;
var NAME=[];

serviceCall({request:"assess"}, function(res) {
	var ajaxDisplay = document.getElementById('ajaxDiv');
	if(res.trim()=="not".trim()){
		document.write("This page is blocked for you.");
	}
	else{
	//	alert(res);
	console.log(res);
		var data=JSON.parse(res);
		if(data.length==0){
			html='<div class="container"><pre style="display: block; padding: 9.5px; margin: 0 0 10px; font-size: 13px; line-height: 1.42857143; color: #333; word-break: break-all; word-wrap: break-word; background-color: #f5f5f5; border: 1px solid #ccc; border-radius: 4px; width:1030px; font-family: Menlo,Monaco,Consolas,Courier New,monospace; overflow:auto;"><h3>Nobody submitted';
			html+='</h3></pre></div>';
			ajaxDisplay.innerHTML=html;
		}
		else{

			var codeDisplay = "";
			var count=Number(data[0]['count']).valueOf();
			var html="<div class='row'>";
			html+="<div class='col-md-12'>";
			html+="<table class='table table-striped' style='margin:2px;'>";
			html+="<thead  style='background-color:#42ABCA;'><tr><td>Student</td>";
			html+="<td>Problem</td>";
			html+="<td style='width:40%;'>Code</td>";
			html+="<td>Yours1/<br>";
			html+="Correct1</td>";
			html+="<td>Yours2/<br>";
			html+="Correct2</td>";
			html+="<td>Yours3/<br>";
			html+="Correct3</td>";
			html+="<td>Yours4/<br>";
			html+="Correct4</td>";
			html+="<td>Problem<br>Weight</td>";
			html+="<td>Assess</td>";
			html+="<td>FeedBack</td>";
			html+="</thead></tr>";
			html+="<tbody>";
			var len=data.length;
			L=len;
			var right=0;
			for(var i=0;i<len;i++){
				right=0;
				NAME.push(data[i]['id']);
				html+='<tr><td>'+data[i]['name']+'</td>';
				
				html+='<td>'+((i%count)+1)+'</td>';
				html+='<td><a onclick="displayCode('+data[i]['id']+')">Show code</a></td>';
				codeDisplay+="<div style='display:none;  border:3px solid #FFFFFF; padding-left:20%; padding-top:60px; margin-left: 20%; margin-right: 20%; font-family:Helvetica Neue,Helvetica,Arial,sans-serif; font-size:1.2em; color: #333; font-weight: normal;' class='codeDisplay' id='codeDisplay"+data[i]['id']+"'>"+data[i]["code"]+"</div>";
				var s1=new String(data[i]['output1']);
				var s2=new String(data[i]['sample1']);
				if(s1.trim()==s2.trim()){
					html+='<td style="background:#5cb85c;">'+data[i]['output1']+'/'+data[i]['sample1']+'</td>';
					right++;
				}
				else if(s1.trim()==''){
					html+='<td style="background:#d9534f;">'+data[i]['output1']+'/'+data[i]['sample1']+'</td>';
				}
				else{
					html+='<td style="background:#f0ad4e;">'+data[i]['output1']+'/'+data[i]['sample1']+'</td>';
				}
				var s1=new String(data[i]['output2']);
				var s2=new String(data[i]['sample2']);
				if(s1.trim()==s2.trim()){
					right++;
					html+='<td style="background:#5cb85c;">'+data[i]['output2']+'/'+data[i]['sample2']+'</td>';
				}
				else if(s1.trim()==''){
					html+='<td style="background:#d9534f;">'+data[i]['output2']+'/'+data[i]['sample2']+'</td>';
				}
				else{
					html+='<td style="background:#f0ad4e;">'+data[i]['output2']+'/'+data[i]['sample2']+'</td>';
				}
				var s1=new String(data[i]['output3']);
				var s2=new String(data[i]['sample3']);
				if(s1.trim()==s2.trim()){
					right++;
					html+='<td style="background:#5cb85c;">'+data[i]['output3']+'/'+data[i]['sample3']+'</td>';
				}
				else if(s1.trim()==''){
					html+='<td style="background:#d9534f;">'+data[i]['output3']+'/'+data[i]['sample3']+'</td>';
				}
				else{
					html+='<td style="background:#f0ad4e;">'+data[i]['output3']+'/'+data[i]['sample3']+'</td>';
				}
				var s1=new String(data[i]['output4']);
				var s2=new String(data[i]['sample4']);
				if(s1.trim()==s2.trim()){
					right++;
					html+='<td style="background:#5cb85c;">'+data[i]['output4']+'/'+data[i]['sample4']+'</td>';
				}
				else if(s1.trim()==''){
					html+='<td style="background:#d9534f;">'+data[i]['output4']+'/'+data[i]['sample4']+'</td>';
				}
				else{
					html+='<td style="background:#f0ad4e;">'+data[i]['output4']+'/'+data[i]['sample4']+'</td>';
				}
				html+='<td>'+data[i]['point']+'</td>';
				data[i]['assest']=parseInt(right*Number(data[i]['point']).valueOf()/4);
				html+='<td><input type="text" value="'+data[i]['assest']+'"'+'id="'+data[i]['id']+'" placeholder="score">'+'</input></td>';

				$feedbackInfo = data[i]['feedback'];
				if($feedbackInfo == "null"){
					$feedbackInfo = "";
				}
				html+='<td><textarea id="'+'feed'+data[i]['id']+'" placeholder="FeedBack">'+$feedbackInfo+'</textarea>';
				
				html+='</tr>';
			}
			html+="</tbody></table>";
			html+=codeDisplay;
			html+='</div></div>';
			ajaxDisplay.innerHTML=html;
		}
	}
});


function release(){
	var assest=[];
	for(var i=0;i<L;i++){
		var id=NAME[i];
		var ass=document.getElementById(id).value;
		var feedback=document.getElementById("feed"+id).value;
		var a={'id':id,'assest':ass,'feedback':feedback};
		assest.push(a);
	}

	serviceCall({request:"release", data: assest}, function(res) {
		var alt = document.getElementById('alert');
		html='<center><pre><h2>Exam Result is released.</h2></pre></center>';
		alt.innerHTML=html;
	});

}



function displayCode(id){
	if(document.getElementById("codeDisplay"+id).style.display == "block"){
		document.getElementById("codeDisplay"+id).style.display = "none";
	} else {
		var disp = document.getElementsByClassName("codeDisplay");
		for(var i=0; i<disp.length; i++){
			disp[i].style.display="none";
		}
		document.getElementById("codeDisplay"+id).style.display="block";
	}
}