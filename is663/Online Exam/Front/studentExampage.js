

var LN;
var DATA=[];

serviceCall({request:"examPage"}, function(res) {
	var ajaxDisplay = document.getElementById('ajaxDiv');
	if(res.trim()=="not".trim()){
		document.write("This page is blocked for you.");
	}
	if(res.trim()=="end".trim()){
		var ajaxDisplay = document.getElementById('alert');
		html="<h3 style='font-size: 24px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;'><center>You have already submitted current exam.";
		html+="</center></h3>";
		ajaxDisplay.innerHTML=html;
	}
	else{
		var data=JSON.parse(res);
		var html='<div class="container">';
		var len=data.length;
		LN=len;
		for(var i=0;i<len;i++){
			DATA.push(data[i]['id']);
			html+='<div><p style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; font-size: 14px; line-height: 1.42857143; color: #333;"><em>Problem'+(i+1)+':</em>';
			html+=data[i]['name']+'</p>';
			html+='<p style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; font-size: 14px; line-height: 1.42857143; color: #333;">Points:'+data[i]['point']+'</p>';
			html+='<label style="display: inline-block; max-width: 100%; margin-bottom: 5px; font-weight: 700; font-family: Helvetica Neue,Helvetica,Arial,sans-serif; font-size: 14px; line-height: 1.42857143; color: #333;">Question Description:</label><br>';
			html+='<pre style="display: block; padding: 9.5px; margin: 0 0 10px; font-size: 13px; line-height: 1.42857143; color: #333; word-break: break-all; word-wrap: break-word; background-color: #f5f5f5; border: 1px solid #ccc; border-radius: 4px; font-family: Menlo,Monaco,Consolas,Courier New,monospace; overflow:auto;">'+data[i]['description']+'</pre>';
			html+='<label style="display: inline-block; max-width: 100%; margin-bottom: 5px; font-weight: 700; font-family: Helvetica Neue,Helvetica,Arial,sans-serif; font-size: 14px; line-height: 1.42857143; color: #333;">Your answer</label><br>';
			html+='<textarea style="width:100%; line-height: 20px; font-size: 14px;" id="'+data[i]['id']+'">'+data[i]['template']+'</textarea><br><br>';
			html+='</div>';
		}
		html+='</div>';
		ajaxDisplay.innerHTML=html;
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
	}

});

//submit exam
function assest(){
	answers=[];
	for(var i=0;i<LN;i++){
		var ans=document.getElementById(DATA[i]).value;
		var ans={"id":DATA[i],"ans":ans};
		answers.push(ans);
	}
	serviceCall({request:"postAnswers", data: answers}, function(res) {
		console.log(res);
		var ajaxDisplay=document.getElementById('ajaxDiv');
		ajaxDisplay.innerHTML=' ';
		var alt = document.getElementById('alert');
		html="<h3 style='font-size: 24px; margin-top: 10px; margin-bottom: 10px; font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;'><center>Submit is done";
		html+="<br>Please see score board to see your score.<center><h3>";
		alt.innerHTML=html;
	});
}
