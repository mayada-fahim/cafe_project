<html>
<style>
.top{
	margin-top: 30px;
}
.left{
	margin-left: 10px;
}
.btn-top{
	margin-top:300px;
}
.margin-left{
	margin-left: 100px;
}
</style>


	<body>
		<?php
require_once 'ORM.php';
require_once 'mainuser.php';
if(!isset($_SESSION['id'])){
	header("Location:http://localhost/project/php/userlogin.php");
}
if($_SESSION['type']=="Admin"){
	echo "PERMISSION DENIED you dont have permission to access this page ";
}
else{


			$my_array=array(
        	
        	);

        $obj=ORM::getInstance();
		$obj->setTable("users");
		$return=$obj->select($my_array);
		//var_dump($return);
		if(!empty($return)){
			
			
			foreach($return as $key=>$value){
				
				foreach($value as $key1=>$value1){
					if($key1=="username"){
						//echo $value1;
						$names[]=$value1;

					}


				}
			}
			//echo $names[0];
		}
		$array=array(
			'status'=>'available'
			);

		$obj->setTable("products");
		$menu=$obj->select($array);
		//var_dump($menu);
		if(!empty($menu)){
			
			
			foreach($menu as $key=>$value){
				
				foreach($value as $key1=>$value1){
					if($key1=="image"){
						//echo $value1;
						$images[]=$value1;

					}
					if($key1=="name"){
						//echo $value1;
						$name_product[]=$value1;

					}
					if($key1=="price"){
						//echo $value1;
						$prices[]=$value1;

					}


				}
			}
			//echo $names[0];
		}


		$for_room=array();
		$obj->setTable("rooms");
		$room=$obj->select($for_room);
		//var_dump($room);
		if(!empty($room)){
			foreach($room as $key=>$value){
				
				foreach($value as $key1=>$value1){
					if($key1=="number"){
						//echo $value1;
						$rooms[]=$value1;

					}
				}
			}
			//var_dump($rooms);

		}
?>

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-5">
					<div class="container-fluid">
						<h2><span class="glyphicon glyphicon-check"></span>	Order</h2>
						<div style="height: 200px; overflow:auto;">
							<table id="write" class="table table-striped table-responsive table-bordered">
								<tr>
									<th class='text-center'>Name</th>
									<th class='text-center'>Quantity</th>
									<th class='text-center'>Total</th>
									<th class='text-center'>Remove</th>
								</tr>
							</table>
						</div>
						
						<hr/>

						<div class="form-group">
							<label for="note">Notes:</label>
							<textarea class="form-control" rows="5" id="note" placeholder="Add you Notes here..."></textarea>
						</div>

						<select id="room" class="form-control">
							<option>Select Room</option>
							<?php for($i=0;$i<count($rooms);$i++){ ?>
								<option value="<?php echo $i ?>">
									<?php echo $rooms[$i]?>
								</option>
							<?php }?>
						</select>

						<hr/>

						<p id="total" class="lead text-center"> </p>
							<button  type="button"id="myBtn" class="btn btn-primary "  name="submit" disabled onclick="send()">confirm
					 	</button> 
					</div>
				</div>
				<div class="col-md-7">
					<div class="container-fluid">
						
						
						<div class="row top">
							<?php for($j=0;$j<count($images);$j++):?>
								<div class="col-md-3 top">
									<img src="../image/<?php echo $images[$j];?>" height="60" width="60" 
									class="img-circle center-block" 
									onclick="myfun(<?php echo $prices[$j]?>,<?php echo "'".$name_product[$j]."'"?>)">
										
									<div class="text-center">
										<p><?php echo $name_product[$j] ?></p>
										<div class="label label-primary"><?php echo $prices[$j]."L.E";?></div>
									</div>	
								</div>
							<?php endfor; ?>
						</div>
					</div>
			  	</div>
			</div>

			<div class="modal fade" id="alert_modal">
				<div class="modal-dialog">
			    	<div class="modal-content">
			      		<div class="modal-header">
				        	<button type="button" class="close" data-dismiss="modal" ><span >&times;</span>
				        	</button>
				        	<h4 class="modal-title text-danger">Error!</h4>
				      	</div>
				      	<div class="modal-body text-danger">
				        	<p id="modal_body"> you must choose user and room no</p>
				      	</div>
				      	<div class="modal-footer">
				        	<button type="button" class="btn btn-primary" data-dismiss="modal">
				        		Close
				        	</button>
				    	</div>
			    	</div>
				</div>
			</div>

		</div>
	<script>
	var array=[];
	var count=0;
	var count=[];
	var prices=0;
	var i=0;
	var zeft=[];

		function myfun(price,name)
		{
			zeft.push(name);
			zeft.push(price);
			var flag;
			prices+=price;

			document.getElementById("myBtn").disabled = false;
			var total=document.getElementById("total");
		
			
			total.innerHTML="TOTAL is "+prices+" L.E";
			for(i=0;i<array.length;i++)
			{
				if(array[i]==(name+"#"))
					flag=1;
			}
			
			if(flag)
			{
				
				elm=document.getElementById(name);
				count=parseInt(document.getElementById(name+".").value);


				
				elm.deleteCell(0);
				elm.deleteCell(1);
				elm.deleteCell(-1);
				elm.deleteCell(-1);

				count+=1;
				console.log(count);
				var index = array.indexOf(name+"#");
				array[index+1]=count+"#";
				btn= document.createElement('button');
				btn.setAttribute("class","btn btn-danger btn-xs");
				btn.setAttribute("id",name);
				numberInput= document.createElement('input');
				numberInput.setAttribute('type','number');
				numberInput.setAttribute("id",name+".");
				//numberInput.setAttribute('value','1');
				numberInput.value=count;
				//price=numberInput.value*price;
				
				span=document.createElement('span');
				span.setAttribute("class","glyphicon glyphicon-remove");
			
    			// newElement.innerHTML = name+" "+count+" "+price+"L.E";

    			var newCell = document.createElement('td');
    			newCell.setAttribute("class","text-center");

    			// NAME
    			//document.getElementById("write").appendChild(elm);
    			elm.appendChild(newCell);
    			newCell.innerHTML = name;

    			// QUANTITY
    			newCell = document.createElement('td');
    			newCell.setAttribute("class","text-center");
    			// newCell.innerHTML = count;
    			newCell.appendChild(numberInput);
    			elm.appendChild(newCell);

    			// TOTAL
    			newCell1 = document.createElement('td');
    			newCell1.setAttribute("class","text-center");
    			newCell1.setAttribute("id",name+".#");
    			newCell1.innerHTML = (price*count);
    			elm.appendChild(newCell1);
    			numberInput.onchange=function(){
    				if(this.value>0){
    				id=this.getAttribute("id");
    				console.log(id);
    				namee=id.substring(0,id.length-1);
    				var ind = zeft.indexOf(namee);
					price=zeft[ind+1];

    				totalp=document.getElementById(id+"#")
    				prices-=parseInt(totalp.innerHTML);
					
					count=this.value;
					console.log(count);

					document.getElementById(id+"#").innerHTML = (price*count);
					prices+=parseInt(totalp.innerHTML);
					//console.log("ok");
					total.innerHTML="TOTAL is "+prices+" L.E";
				}
				else{
					this.value=1;
				}

				}

    			// REMOVE
    			newCell = document.createElement('td');
    			newCell.setAttribute("class","text-center");
    			btn.appendChild(span);
    			newCell.appendChild(btn);
    			elm.appendChild(newCell);
    			

    			btn.onclick=function(){
    				id=this.getAttribute("id");
    			    remove=document.getElementById(id);
    			    c=document.getElementById(id+".");
    			    //console.log(c.value);

    	
    	 			var index = array.indexOf(id+"#");
    	 			array.splice(index,2);
    	 			totalp=document.getElementById(id+".#");
    	 			//console.log(totalp.value);
    	 			prices-=(totalp.innerHTML);
    	

					document.getElementById("write").removeChild(remove);
    				total.innerHTML="TOTAL is "+prices+" L.E";

					
				};
			}
			else
			{
				array.push(name+"#");

				count=1;
				array.push(count+"#");
				
				newElement = document.createElement('tr');
				newElement.setAttribute("id",name);

				btn= document.createElement('button');
				btn.setAttribute("class","btn btn-danger btn-xs");
				btn.setAttribute("id",name);
				//btn.value=i;
    			i+=2;

				numberInput= document.createElement('input');
				numberInput.setAttribute('type','number');
				numberInput.setAttribute('value','1');
				numberInput.setAttribute("id",name+".");
				//price=numberInput.value*price;
				
				span=document.createElement('span');
				span.setAttribute("class","glyphicon glyphicon-remove");
			
    			// newElement.innerHTML = name+" "+count+" "+price+"L.E";

    			var newCell = document.createElement('td');
    			newCell.setAttribute("class","text-center");

    			// NAME
    			document.getElementById("write").appendChild(newElement);
    			newElement.appendChild(newCell);
    			newCell.innerHTML = name;

    			// QUANTITY
    			newCell = document.createElement('td');
    			newCell.setAttribute("class","text-center");
    			// newCell.innerHTML = count;
    			newCell.appendChild(numberInput);
    			newElement.appendChild(newCell);

    			// TOTAL
    			newCell1 = document.createElement('td');
    			newCell1.setAttribute("class","text-center");
    			newCell1.setAttribute("id",name+".#");
    			newCell1.innerHTML = (price*count);
    			newElement.appendChild(newCell1);
    			numberInput.onchange=function(){
    				if(this.value>0){
    				id=this.getAttribute("id");
    				console.log(id);
    				namee=id.substring(0,id.length-1);
    				var ind = zeft.indexOf(namee);
					price=zeft[ind+1];
    				totalp=document.getElementById(id+"#")
    				prices-=parseInt(totalp.innerHTML);
					
					count=this.value;
					console.log(count);

					document.getElementById(id+"#").innerHTML = (price*count);
					prices+=parseInt(totalp.innerHTML);
					//console.log("ok");
					total.innerHTML="TOTAL is "+prices+" L.E";
				}
				else{
					this.value=1;
				}

				}

    			// REMOVE
    			newCell = document.createElement('td');
    			newCell.setAttribute("class","text-center");
    			btn.appendChild(span);
    			newCell.appendChild(btn);
    			newElement.appendChild(newCell);

    			btn.onclick=function(){
    				id=this.getAttribute("id");
    			    remove=document.getElementById(id);
    			    c=document.getElementById(id+".");
    			    console.log(c.value);
    	
    	 			var index = array.indexOf(id+"#");
    	 			array.splice(index,2);
    	 			totalp=document.getElementById(id+".#");
    	 			console.log(totalp.innerHTML);
    	 			prices-=(totalp.innerHTML);
    	

					document.getElementById("write").removeChild(remove);
					
    				total.innerHTML="TOTAL is "+prices+" L.E";
				};
    		}
		}

		function send()
		{
			var exampleSocket = new WebSocket("ws://127.0.0.1:8080");
			var room = document.getElementById("room");
			
			var roomno=room.options[room.selectedIndex].text;
			
			var name="<?php echo $_SESSION['username']; ?>";
				alert(name);
			
			//console.log(str);
			if(roomno!="Select Room")
			{
				alert("your order has been sent");
				var note=document.getElementById("note").value;

				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function()
				{
		            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		               
		                r=JSON.parse(xmlhttp.responseText);
		                exampleSocket.onopen = function (event) 
		       			 {
	 // exampleSocket.send("Here's some text that the server is urgently awaiting!"); 
								}

				
	    				exampleSocket.send("order"+","+r.date+","+name+","+roomno+","+r.status+","+r.order_id);
		                //console.log(r.user_id);
		            }
				}

		        xmlhttp.open("POST", "mimi.php", true);
		        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		        xmlhttp.send("name="+name+"&"+"room="+roomno+"&"+"notes="+note+"&"+"data="+array+"&"+"total="+prices);
		       

				
	    		
	    		for (i=0;i<array.length;i+=2){
	    			console.log(array[i].substring(0,array[i].length-1));
	    			var rem=document.getElementById(array[i].substring(0,array[i].length-1));
	    			document.getElementById("write").removeChild(rem);
	    		} 
	    		var total=document.getElementById("total");
	    		total.innerHTML="";
	    		room.value="Select Room";
	    		user.value="Customer Name ...";
	    		// for(j=0;j<array.length;j++){
	    		// 	array.pop();
	    		// }
	    		array=[];
	    		console.log(array);
	    		prices=0;
	    		count=0;
	    		zeft=[];
	    		count=[];
	    		
			}

			

			else if(roomno=="Select Room"){
				$('#alert_modal').modal();
			}
		}

	</script>



<?php } ?>


	</body>
</html>