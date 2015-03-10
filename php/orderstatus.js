function ajax (query,status){




		                //console.log(r.user_id);
		               // exampleSocket.send("order"+","+r.date+","+name+","+roomno+","+r.status+","+r.order_id+","+r
	if (window.XMLHttpRequest){
		ajaxRequest=new XMLHttpRequest();
	}
	else{
		ajaxRequest=new ActiveXObject("Microsoft.XMLHTTP");
	}
	ajaxRequest.open("POST","orderstatus.php",true);

	parameter="id="+query+"&status="+status;
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	ajaxRequest.send(parameter);

	ajaxRequest.onreadystatechange=function(){

	if (ajaxRequest.readyState===4&& ajaxRequest.status===200){
	response=ajaxRequest.responseText;
	var string_split=[],status;
	string_split=response.split(",");
			
	if (string_split[0]=='processing'){
		status='Done';
		var btn=document.getElementById(parseInt(string_split[1])).remove();
	}
	else
		status='processing';

	//console.log(string_split[1]);

	// document.getElementById(parseInt(string_split[1])).value=status;
	//var elem = document.getElementById('row');
//document.removeChild(document.getElementById('row'));
		//console.log(status);

		

}
};
	

}

