function ajax(){
	console.log("here");
	
	if (window.XMLHttpRequest){
		ajaxRequest=new XMLHttpRequest();
	}
	else{
		ajaxRequest=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
start=document.getElementById("start").value;
end=document.getElementById("end").value;
if(start && end){
ajaxRequest.open("POST","date.php",true);
parameter="start="+start+"&end="+end;
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	ajaxRequest.send(parameter);
}
	ajaxRequest.onreadystatechange=function(){

	if (ajaxRequest.readyState===4&& ajaxRequest.status===200){

	response=ajaxRequest.responseText;//get all row as one string
	console.log(response);
	
		var rows_array=response.split("#");//split by # to number of row

console.log(rows_array.length);

var totalPrice=0;
if(rows_array.length==1 && response.trim()=="error"){
	if(document.getElementById("ordertable")){
var table1=document.getElementById("ordertable").remove();
}
if(document.getElementById("span")){
var span1=document.getElementById("span").remove();
}

var containerDiv=document.createElement('div');
containerDiv.setAttribute('class','container');
containerDiv.setAttribute('id','error');
var textDiv=document.createElement('div');
textDiv.setAttribute('class','text-danger');

var text=document.createTextNode('. there is no order in this date');
textDiv.appendChild(text);

containerDiv.appendChild(textDiv);
document.body.appendChild(containerDiv);

}
else if(rows_array.length>=1){
console.log("mayada");
var newrow;//create newrow
var newcol;//create new col
var newtext;//create new text
var cols_array;
var table1=document.getElementById("ordertable");
var divError=document.getElementById("error");
var divDisplay=document.getElementById("div");
var spanDisplay=document.getElementById("span");


if(spanDisplay){spanDisplay.remove();}
if(divDisplay){divDisplay.remove();}
if(divError){divError.remove();}
if(table1){
table1.remove();
}

var container=document.createElement("div");
container.setAttribute('class','container');
var table=document.createElement("table");
table.setAttribute('id','ordertable');
table.setAttribute('class','table table-bordered');
var tableBody = document.createElement('tbody');
var headerRow = document.createElement('tr');

var table_th1=document.createElement("th");
var th_text1=document.createTextNode("Orderdate");
//table_th1.setAttribute('class','table table-bordered');
table_th1.appendChild(th_text1);
headerRow.appendChild(table_th1);

var table_th2=document.createElement("th");
var th_text2=document.createTextNode("Status");
//table_th2.setAttribute('class','table table-bordered');
table_th2.appendChild(th_text2);
headerRow.appendChild(table_th2);

var table_th3=document.createElement("th");
var th_text3=document.createTextNode("Amount");
//table_th3.setAttribute('class','table table-bordered');
table_th3.appendChild(th_text3);
headerRow.appendChild(table_th3);

var table_th4=document.createElement("th");
var th_text4=document.createTextNode("Action");
//table_th4.setAttribute('class','table table-bordered');
table_th4.appendChild(th_text4);
headerRow.appendChild(table_th4);
tableBody.appendChild(headerRow);
table.appendChild(tableBody);


		for(row=0 ;row<rows_array.length;row++){
				
			newrow=document.createElement('tr');
			newrow.setAttribute('id',row);
			//newrow.setAttribute('class','table table-bordered text-center');
			cols_array=rows_array[row].split(",");

    totalPrice=totalPrice+parseInt(cols_array[2]);
				
			for(column=0 ;column<(cols_array.length);column++){

				if(column==3){
					
				newcol=document.createElement('td');//create new column
				if(cols_array[1]=='processing'){
					var cancelbutton=document.createElement("button");
					var cancelText=document.createTextNode("cancel");
					cancelbutton.setAttribute('class','btn btn-warning');
					cancelbutton.setAttribute('id','btn'+cols_array[7]);
					cancelbutton.setAttribute('name',row);
					cancelbutton.onclick=function(){
					cancel(this.id,this.name);
					}
					cancelbutton.appendChild(cancelText);
					newcol.appendChild(cancelbutton);

					}
					newrow.appendChild(newcol);


					}
				else if(column==4 ||column==5 ||column==6||column==7){

					}
				else{

				
				newcol=document.createElement('td');//create new column
				if(column==0){
				newbtn=document.createElement('button');//create new column
				newbtn.setAttribute('value',row);//id of selected row
				newbtn.setAttribute('id',"zorar"+cols_array[7]);//buton id equal to date
				newbtn.setAttribute('name',cols_array[3]+'$'+cols_array[4]+'$'+cols_array[5]+'$'+cols_array[6]);// button name equal to photo name concat with  price and name
				newbtn.setAttribute('class','oldbutton');
				newbtntxt=document.createTextNode('+');//create new column
				newbtn.appendChild(newbtntxt);
				newcol.appendChild(newbtn);
				newbtn.onclick=function(){
				check(this.value,this.name,this.id);
				}
				
				}
				newtext=document.createTextNode(cols_array[column]);//take selected value in selected column
				newcol.appendChild(newtext);
				newrow.appendChild(newcol);
				}
			}
		
			tableBody.appendChild(newrow);
			// table.appendChild(newrow);
		}

var span1=document.createElement("span");
span1.style.float='right';
span1.setAttribute('id','span');
var total=document.createTextNode("EGP"+totalPrice);

var spanDiv=document.createElement("div");
spanDiv.setAttribute('class','label label-primary');


document.body.appendChild(container);
container.appendChild(table);

spanDiv.appendChild(total);
span1.appendChild(spanDiv);
container.appendChild(span1);
	


 



}
}
	

}
}




function check(value,name,id){

var bton=document.getElementById(id);

if(bton.innerHTML.trim()=='+'){

					
					ajax1(value,name,id);
					
					}
				else if(bton.innerHTML=='-'){
					
					ajax2(value,name,id);

					}
}




function ajax1(id,photo,bton_id){


var allButton=[];
var olddiv=document.getElementById('div');
if(olddiv){
olddiv.remove();
//allButton=document.getElementById('2013-09-01 00:00:00');
allButton=document.getElementsByClassName("oldbutton");

for(b=0;b<allButton.length;b++){
allButton[b].innerHTML='+';
}
}


var select_button=document.getElementById(bton_id);
select_button.innerHTML='-';
var select=document.getElementById(id);
newdiv=document.createElement('div');
newdiv.setAttribute('class','container span4 offset2');

divname='div';
newdiv.setAttribute('id',divname);
newdiv.style.border="1px solid";
newdiv.style.width="900px";

var newdiv_row1=document.createElement('div');
newdiv_row1.setAttribute('class','row');
var newdiv_row2=document.createElement('div');
newdiv_row2.setAttribute('class','row');
var newdiv_row3=document.createElement('div');
newdiv_row3.setAttribute('class','row');
var newdiv_row4=document.createElement('div');
newdiv_row4.setAttribute('class','row');


photo=photo.trim();

array_photo_price=photo.split('$');


array_photo=array_photo_price[0].split('@');

array_price=array_photo_price[1].split('|');
array_name=array_photo_price[2].split('*');
array_amount=array_photo_price[3].split('&');

for(i=0;i<(array_photo.length);i++){

var newdiv_col1=document.createElement('div');
newdiv_col1.setAttribute('class','col-md-3');
var newdiv_col2=document.createElement('div');
newdiv_col2.setAttribute('class','col-md-3');
var newdiv_col3=document.createElement('div');
newdiv_col3.setAttribute('class','col-md-3');
var newdiv_col4=document.createElement('div');
newdiv_col4.setAttribute('class','col-md-3');

var newdiv_col5=document.createElement('div');
newdiv_col5.setAttribute('class','col-md-3 label label-primary');

//spanDiv.setAttribute('class','label label-primary');


imag=document.createElement('img');
imag.setAttribute('src','../image/'+array_photo[i]);
imag.setAttribute('height','60px');
imag.setAttribute('width','60px');
imag.setAttribute('class','img-circle col -md-3');
var price=document.createTextNode(array_price[i]+"LE");
var name=document.createTextNode(array_name[i]);
var amount=document.createTextNode(array_amount[i]);

newdiv_col1.appendChild(imag);
newdiv_col2.appendChild(name);

newdiv_col5.appendChild(price);
newdiv_col3.appendChild(newdiv_col5);
newdiv_col4.appendChild(amount);
newdiv_row1.appendChild(newdiv_col1);
newdiv_row2.appendChild(newdiv_col2);
newdiv_row3.appendChild(newdiv_col3);
newdiv_row4.appendChild(newdiv_col4);
//newdiv_row1.appendChild(imag);
//newdiv_row2.appendChild(price);
}

newdiv.appendChild(newdiv_row1);
newdiv.appendChild(newdiv_row2);
newdiv.appendChild(newdiv_row3);
newdiv.appendChild(newdiv_row4);
var newline =document.createElement('br');

var span11=document.getElementById("span");

var container=document.createElement('div');
container.setAttribute('class','container');
//document.body.appendChild(newline);

document.body.appendChild(newdiv);
container.appendChild(span11);
document.body.appendChild(container);
//var newdiv_row4=document.createElement('div');
//newdiv_row4.setAttribute('class','row');

}

function ajax2(id,photo,bton_id){

var select_button=document.getElementById(bton_id);
select_button.innerHTML='+';




divname='div';
var selected_div=document.getElementById(divname).remove();


}
function cancel(param,row){

var exampleSocket = new WebSocket("ws://127.0.0.1:8080");
if (window.XMLHttpRequest){
ajaxRequest=new XMLHttpRequest();
}
else{
ajaxRequest=new ActiveXObject("Microsoft.XMLHTTP");
}
ajaxRequest.open("POST","cancelorder.php",true);
var param=param.split('btn');
console.log(param[1]);

parameter="param="+param[1]+"&row="+row;
ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
ajaxRequest.send(parameter);

ajaxRequest.onreadystatechange=function(){

if (ajaxRequest.readyState===4&& ajaxRequest.status===200){

response=ajaxRequest.responseText;//get all row as one string

console.log(response);
exampleSocket.onopen = function (event) 
{
	 // exampleSocket.send("Here's some text that the server is urgently awaiting!"); 
	}

exampleSocket.send("cancel"+","+param[1]);
//var cancel=document.getElementById(param);

var rowdelete=document.getElementById(response).remove();

}
}
}




