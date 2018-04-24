function serviceCall(jsonObject, doFunction){
    var ajaxRequest;
    try{
        ajaxRequest = new XMLHttpRequest();
    } catch (e){
        // Internet Explorer Browsers
        try{
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try{
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
                alert("This program is not compatible with your browser: (Try a different browser)");
            }
        }
    }

	ajaxRequest.onreadystatechange = function() {
		if (ajaxRequest.readyState == XMLHttpRequest.DONE) {
			doFunction(ajaxRequest.responseText);
		}
    }
	ajaxRequest.open("POST", "serviceHandler.php", true);
	ajaxRequest.send(JSON.stringify(jsonObject));
}