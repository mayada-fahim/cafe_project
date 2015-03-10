function  addcat(){


var category=document.getElementById("categorybton");

var divcontain=document.getElementById("btonDiv");
divcontain.innerHTML="<div class=' pull-right'> <input type='text'class='form-control1' id='categoryname'></div><div class='form-group'><label class='pull-right'>AddCategory:</label></div><br><br><br> <input type='submit' name ='submit' value='save' class='btn btn-default pull-right' onclick='savcat()'>";


}

function savcat(){
if (window.XMLHttpRequest){
		ajaxRequest=new XMLHttpRequest();
	}
	else{
		ajaxRequest=new ActiveXObject("Microsoft.XMLHTTP");
	}
	ajaxRequest.open("POST","cat.php",true);

var categoryInput=document.getElementById('categoryname').value;


parameter="cat="+categoryInput;
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	ajaxRequest.send(parameter);

	ajaxRequest.onreadystatechange=function(){

	if (ajaxRequest.readyState===4&& ajaxRequest.status===200){

	response=ajaxRequest.responseText;//get all row as one string
console.log(response);

if(response.trim()=='done'){

var divcontain=document.getElementById("btonDiv");
divcontain.innerHTML="<button class='btn btn-primary pull-right' role='button' id='categorybton' onclick='addcat()'>AddCategory</button>";
window.location = "http://localhost/project/php/addproduct.php";
}
else{

var divcontain=document.getElementById("btonDiv");
divcontain.innerHTML="<div class=' pull-right'> <input type='text'class='form-control1' id='categoryname'></div><div class='form-group'><label class='pull-right'>AddCategory:</label></div><br><br><div class='pull-right text-danger'>you must enter the value </div><br> <input type='submit' name ='submit' value='save' class='btn btn-default pull-right' onclick='savcat()'>";
}


}
}
}
