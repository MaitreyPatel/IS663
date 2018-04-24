
serviceCall({request:"scoreboard"}, function(res) {
	var ajaxDisplay = document.getElementById('ajaxDiv');
	if(res.trim()=="not".trim()){
		document.write("This page is blocked for you.");
	}
	else{
		console.log(res);
		var data=JSON.parse(res);
		if(data.length==0){
			html='<div class="container"><center><pre style="display: block; padding: 9.5px; margin: 0 0 10px; font-size: 13px; line-height: 1.42857143; color: #333; word-break: break-all; word-wrap: break-word; background-color: #f5f5f5; border: 1px solid #ccc; border-radius: 4px; width:1030px; font-family: Menlo,Monaco,Consolas,Courier New,monospace; overflow:auto;"><h3>Teacher has not yet released exam result';
			html+='</h3></pre></center></div>';
			ajaxDisplay.innerHTML=html;
		}else {

			var html="<div class='row' style='margin-left:2px;'>";
			html+="<div class='col-mod-12'>";
			html+="<center><h2 style='font-size: 30px; margin-top: 20px; margin-bottom: 10px; font-family:inherit; font-weight: 500; line-height: 1.1; color: inherit;'>The Result of ";
			html+=data[0]['exam']+"</h2></center>";
			html+="<table class='table table-striped'>";
			html+="<thead style='background:#42ABCA;'><tr>";
			html+="<th>Student</th>";
			var cnt=data[0]['count'];
			for(var i=0;i<cnt;i++){
				html+='<th>Problem'+(i+1)+'<br>Score/Weight'+'</th>';
			}
			html+='<th>Possible<br>Points</th>';
			html+='<th>Total</th>';
			html+='<th>FeedBack</th>';
			html+="</tr></thead>";
			var len=data.length;
			L=len;
			html+="<tbody>";
			var total;
			var i=Number(0);
			var point=Number(0);
			while(i<len){
				total=(0).valueOf();
				point=(0).valueOf();
				feedback="";
				html+='<tr>';
			//	html+='<td>'+data[i]['stdId']+'</td>';
				html+='<td>'+data[i]['name']+'</td>';
				for(var j=0;j<cnt;j++){
					var s1=new String(data[i]['assest']);
					var s2=new String(data[i]['point']);
					if(s1.trim()==s2.trim()){
						html+='<td style="background:#5cb85c;">'+data[i]['assest']+'/'+data[i]['point']+'</td>';
					}
					else if(s1.trim()=='0'){
						html+='<td style="background:#d9534f;">'+data[i]['assest']+'/'+data[i]['point']+'</td>';
					}
					else{
						html+='<td style="background:#f0ad4e;">'+data[i]['assest']+'/'+data[i]['point']+'</td>';
					}
					total+=(Number(data[i]['assest'])).valueOf();
					point+=(Number(data[i]['point'])).valueOf();
					
					if(data[i]['feedback']){
						feedback+= "(Problem"+(i+1)+": "+data[i]['feedback']+"),";
					}
					i++;
				}
				html+='<td>'+point+'</td>';
				html+='<td>'+total+'</td>';
				
				html+='<td>'+feedback.replace(/(^\s*,)|(,\s*$)/g, '');+'</td>';
				html+='</tr>';
			}
			html+="</tbody></table>";
			html+="</div></div>";
			ajaxDisplay.innerHTML=html;
		}
	}

});