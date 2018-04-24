//Maitrey Patel
//CS490

//viewresult.js
serviceCall({request:"examResults"}, function(res) {
	var ajaxDisplay = document.getElementById('ajaxDiv');
	if(res.trim()=="not".trim()){
		//window.location.replace("login.php");
		document.write("This page is blocked for you.");
	}
	else{
		console.log(res);
		var data=JSON.parse(res);
		if(data.length==0){
			var html='<div class="container">';
			html+='<center><pre style="display: block; padding: 9.5px; margin: 0 0 10px; font-size: 13px; line-height: 1.42857143; color: #333; word-break: break-all; word-wrap: break-word; background-color: #f5f5f5; border: 1px solid #ccc; border-radius: 4px; font-family: Menlo,Monaco,Consolas,Courier New,monospace; overflow:auto;"><h3>Exam Result is not yet released.</h3></pre></center>';
			html+='</div>'
			ajaxDisplay.innerHTML=html;
		}
		else{
			var cnt=data[0]['count'];
			var html="<div>";
			var total=0;
			var point=0;
			for(var i=0;i<cnt;i++){
				html+='<div class="container">'
				point+=Number(data[i]['point']);
				html+='<h3 style="font-size: 24px; margin-top: 20px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">Probem'+(i+1)+'('+data[i]['point']+'<em> points)'+'</em></h3>';
				html+='<h4 style="font-size: 18px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">'+'Question Description'+'</h4>';
				html+='<pre style="display: block; padding: 9.5px; margin: 0 0 10px; font-size: 13px; line-height: 1.42857143; color: #333; word-break: break-all; word-wrap: break-word; background-color: #f5f5f5; border: 1px solid #ccc; border-radius: 4px; overflow:auto; font-family: Menlo,Monaco,Consolas,Courier New,monospace;">'+data[i]['question']+'</pre>';
				html+='<h4 style="font-size: 18px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">Code</h4>';
				html+='<pre style="display: block; padding: 9.5px; margin: 0 0 10px; font-size: 13px; line-height: 1.42857143; color: #333; word-break: break-all; word-wrap: break-word; background-color: #f5f5f5; border: 1px solid #ccc; border-radius: 4px; overflow:auto; font-family: Menlo,Monaco,Consolas,Courier New,monospace;">'+data[i]['code']+'</pre>';
				html+='<h4 style="font-size: 18px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">Result</h4>';
				html+='<table class="table" style="width:50%;">';
				html+='<thead><tr>';
				html+='<th>Case#</th>';
				html+='<th>Debug</th>';
				html+='<th>Output</th>';
				html+='<th>CorrectOutput</th>';
				html+='</thead></tr>';
				html+='<tbody>';
				var s1=new String(data[i]['output1']);
				var s2=new String(data[i]['sample1']);
				if(s1.trim()==s2.trim()){
					html+='<tr style="background:#5cb85c;">';
					var hl='<td>Right</td>';
				}
				else if(s1.trim()==''){
					html+='<tr style="background:#d9534f;">';
					var hl='<td>Not Complied</td>';
				}
				else{
					html+='<tr style="background:#f0ad4e;">';
					var hl='<td>Wrong</td>';
				}
				html+='<td>Case1</td>';
				html+=hl;
				html+='<td>'+data[i]['output1']+'</td>';
				html+='<td>'+data[i]['sample1']+'</td>';
				html+='</tr>';
				var s1=new String(data[i]['output2']);
				var s2=new String(data[i]['sample2']);
				if(s1.trim()==s2.trim()){
					html+='<tr style="background:#5cb85c;">';
					var hl='<td>Right</td>';
				}
				else if(s1.trim()==''){
					html+='<tr style="background:#d9534f;">';
					var hl='<td>Not Complied</td>';
				}
				else{
					html+='<tr style="background:#f0ad4e;">';
					var hl='<td>Wrong</td>';
				}
				html+='<td>Case2</td>';
				html+=hl;
				html+='<td>'+data[i]['output2']+'</td>';
				html+='<td>'+data[i]['sample2']+'</td>';
				html+='</tr>';
				var s1=new String(data[i]['output3']);
				var s2=new String(data[i]['sample3']);
				if(s1.trim()==s2.trim()){
					html+='<tr style="background:#5cb85c;">';
					var hl='<td>Right</td>';
				}
				else if(s1.trim()==''){
					html+='<tr style="background:#d9534f;">';
					var hl='<td>Not Compiled</td>';
				}
				else{
					html+='<tr style="background:#f0ad4e;">';
					var hl='<td>Wrong</td>';
				}
				html+='<td>Case3</td>';
				html+=hl;
				html+='<td>'+data[i]['output3']+'</td>';
				html+='<td>'+data[i]['sample3']+'</td>';
				html+='</tr>';
				var s1=new String(data[i]['output4']);
				var s2=new String(data[i]['sample4']);
				if(s1.trim()==s2.trim()){
					html+='<tr style="background:#5cb85c;">';
					var hl='<td>Right</td>';
				}
				else if(s1.trim()==''){
					html+='<tr style="background:#d9534f;">';
					var hl='<td>Not Compiled</td>';
				}
				else{
					html+='<tr style="background:#f0ad4e;">';
					var hl='<td>Wrong</td>';
				}
				html+='<td>Case4</td>';
				html+=hl;
				html+='<td>'+data[i]['output4']+'</td>';
				html+='<td>'+data[i]['sample4']+'</td>';
				html+='</tr>';
				html+='</tbody>'
				html+='</table>';
				html+='<h4 style="font-size: 18px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">My Score</h4>';
				html+=data[i]['assest']+'<em style="font-style: italic; font-family: Helvetica Neue,Helvetica,Arial,sans-serif; font-size: 14px; line-height: 1.42857143; color: #333;"> points</em>';
				html+='<h3 style="font-size: 24px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">Feedback</h3>';
				html+='<pre style="display: block; padding: 9.5px; margin: 0 0 10px; font-size: 13px; line-height: 1.42857143; color: #333; word-break: break-all; word-wrap: break-word; background-color: #f5f5f5; border: 1px solid #ccc; border-radius: 4px; width:1030px; font-family: Menlo,Monaco,Consolas,Courier New,monospace; overflow:auto;">'+data[i]['feedback']+'</pre>';
				total+=Number(data[i]['assest']);
				html+='</div>'
				
			}
			html+='<div class="container">'
			html+='<h3 style="font-size: 24px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;">Total Score</h3>';
			html+=total+'(/'+point+')'+'<em style="font-style: italic; font-family: Helvetica Neue,Helvetica,Arial,sans-serif; font-size: 14px; line-height: 1.42857143; color: #333;"> points</em>';
			
			html+='</div>';
			html+="</div>";
			ajaxDisplay.innerHTML=html;
		}
	}
});