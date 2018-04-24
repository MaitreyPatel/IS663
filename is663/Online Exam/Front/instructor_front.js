serviceCall({request:"instructorPage"}, function(res) {
	var ajaxDisplay = document.getElementById('ajaxDiv');
	if(res.trim()=="not".trim()){
		document.write("This page is blocked for you.");
	}
});
