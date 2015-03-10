
<html>
<head>
<title>All Orders Admin Side</title>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="orderstatus.js"></script>


</head>
<?php 
include_once( "ORM.php");
include "main.php";
if(!isset($_SESSION['id'])){
  header("Location:http://localhost/project/php/userlogin.php");
}
if($_SESSION['type']=="user"){
  echo "PERMISSION DENIED ";
  echo "you dont have permission to access this page";

}
else{
$all =ORM::getInstance();
 $all-> setTable("orderss");
 $array=$all->select(array('status'=>'processing'));//
 //var_dump(count($array));

 //var_dump($array[0]['status']);//"deliver" 
 //var_dump($array[0]);
 // array(6) { ["id"]=> string(1) "1" ["user_id"]=> string(1) "2" ["room_id"]=> string(1) "1" ["date"]=> string(19) "2015-03-02 19:08:34" ["notes"]=> string(11) "Extra Suger" ["status"]=> string(7) "deliver" }
//var_dump($array[0]['user_id']);

///orderdate|Name|Room|Ext|Action|Image (count,Name,price)|Total

//-----------------------------------------


 //***************************************************

/*
To get Number Room $EXT  of Order
*/
 //-------------------for($i=0;$i<count($array);$i++){
 $roomNumber =ORM::getInstance();
  $roomNumber-> setTable("rooms");
// $roomcond=array('id'=>$array[$i]['room_id']);//Zero will convert to i
//  		$roomarr=$roomNumber->select($roomcond);
//  		$Room=($roomarr[0]['number']);//Zero will not convert to i =========> ROOM Number
//  		// echo"<br>Number of Room";
//  		// var_dump($Room);
// //-------------------------------------
// /*
// To get  Room Ext  of Order
// */

// $Ext=($roomarr[0]['phone']);//Zero will not convert to i///// =========> ROOM Ext
// // echo"<br>Ext";
// // echo $Ext;
// ///***************************************************
// /*
// To Select Date of Order
// */
// $orderdate=$array[$i]['date'];//Zero will convert to i=====================================>Dateof prder
// // echo"<br>Date of Order";
// // var_dump($orderdate);
// //***************************************************
// /*
// To Select Action of Order
// */
// $orderAction=$array[$i]['status'];//Zero will convert to i=====================================>Actionof prder
// // echo"<br>Action of Order";
// var_dump($orderAction);
//***************************************************


/*

To get User Name(owner)  of Order
*/
 $user =ORM::getInstance();
 $user-> setTable("users");
// $usercond=array('id'=>$array[$i]['user_id']);//Zero will convert to i
//  		$username=$user->select($usercond);
//  		$Name=($username[0]['username']);//Zero will not convert to i=====================> user name of ord
//  		// echo"<br>Name of person";
//  		// echo $Name;
// // //**************************************************

 
//  /*
// To select order id
//  */

// $orderid=$array[$i]['id'];//order id//Zero will convert to i
// var_dump($orderid);
//}
//**************************************************
//&&&&&&&&&&&&&&&&&&&From order_product====================================

/*
To select Products according order id
*/
 $allproduct =ORM::getInstance();
  $allproduct-> setTable("order_product");
// // //
//  $productcond=array('order_id '=>$orderid);//Zero will convert to i
//   		$Prodcys=$allproduct->select($productcond);
//   		// echo"-Number of product in One order-";
//   		// var_dump(count($Prodcys));
//   		for($j=0;$j<count($Prodcys);$j++){
  		
//   		//$Name=($username[0]['username'])
//   		//var_dump($Prodcys[0]['product_id']);
//   		$productid=$Prodcys[$j]['product_id'];
//  		$productcount=$Prodcys[$j]['count'];//=======================>Count Of Product
//   		// echo"<br>Count of Product";
//   		// var_dump($productcount);
//  		//-------------------------------------------------------
//  		Select name &Image of Product
 	$product_data=ORM::getInstance();
 	 $product_data-> setTable("products");
 	// $productcond=array('id '=>$productid);//Zero will convert to i
  // 	$Pro=$product_data->select($productcond);//
  // 	$productName=$Pro[0]['name'];//===================================>Name Of Product
  // 	$productImage=$Pro[0]['image'];//===========================>cImage Of Product
  // 	$productPrice=$Pro[0]['price'];//===========================>Price Of Product
  // 	// echo"<br>Name of Product";
  // 	//  var_dump($Pro[0]['name']);//Name Of Product
  // 	//  echo"<br>Image of Product";
  // 	//  var_dump($Pro[0]['image']);//Image Of Product
  // 	//  echo"<br>Price of Product";
  // 	// var_dump($Pro[0]['price']);//Iprice Of Product
 //--------------------------------------------------------- }

//----------------------------------------}
?>



<body>

<div class="container">
<a href="/project/Mayada.php"  class="btn btn-primary pull-right"  role="button" >Add Order</a>
<table  class="table table-bordered text-center" id="table">
<th><center>Order Date</th>
<th><center>Name</th>
<th><center>Room</th>
<th><center>Ext</th>
<th><center>Action</th>
<!--th><COLSPAN=5><center>Order Details</th>
<!-- for($item=0;$item<count($selected_items);$item++) -->
<?php for($i=0;$i<count($array);$i++){ ?>

<tr id="<?php echo $array[$i]['id']?>">
 <td><?php echo$array[$i]['date']; ?></td> 
 <td><?php 
 //echo//$array[$i]['user_id'][$username[0]['username'])];
 
 $user-> setTable("users");
 	$usercond=array('id'=>$array[$i]['user_id']);//Zero will convert to i
 		$username=$user->select($usercond);
 		$Name=($username[0]['username']);//Zero will not convert to i=====================> user name of ord
 		echo $Name;

 				 ?></td> 
 <td><?php  
	$roomNumber-> setTable("rooms");
	$roomcond=array('id'=>$array[$i]['room_id']);//Zero will convert to i
 		$roomarr=$roomNumber->select($roomcond);
 		$Room=($roomarr[0]['number']);
 		echo$Room; 


 echo"</td>"; 
 echo" <td>";
  $Ext=($roomarr[0]['phone']);
  echo $Ext;



   ?></td> 

<td>
<!-- <a href="<?php echo $array[$i]['status'];  ?>" class="btn btn-info" role="button" ><?php echo $array[$i]['status']; ?></a> -->
-
<input type="submit" id="<?php echo $array[$i]['id'];  ?>" class="btn btn-info" value="<?php echo $array[$i]['status']; ?>" 

onclick="ajax(<?php echo $array[$i]['id']?>,'<?php echo $array[$i]['status'];?>')">

<script   type="text/javascript">
 if(document.getElementById("<?php echo $array[$i]['id'];  ?>").value=="Done")
{
    document.getElementById("<?php echo $array[$i]['id'];  ?>").disabled=true;
    

var elem = document.getElementById("<?php echo $array[$i]['id']?>");
elem.parentNode.removeChild(elem);

// var elem2 = document.getElementById('co');
//     elem2.parentNode.removeChild(elem2);
 

}


</script>





   </td> 
 

   <!-- </tr> -->
    <td>

   <div class="row">
   <?php 

//$allproduct =ORM::getInstance();
 $allproduct-> setTable("order_product");
// //
 $productcond=array('order_id '=>$array[$i]['id']);//Zero will convert to i
  		$Prodcys=$allproduct->select($productcond);

   for($j=0;$j<count($Prodcys);$j++){ ?>
  

 
   <div id="mydiv" class="col-md-2"> <?php 

//echo count($Prodcys);
$product_data-> setTable("products");
 	$productcond=array('id '=>$Prodcys[$j]['product_id']);//Zero will convert to i
 	$productcount=$Prodcys[$j]['count'];//=======================>Count Of Product
  	$Pro=$product_data->select($productcond);//
    // var_dump($Pro);
  	$productName=$Pro[0]['name'];//===================================>Name Of Product
  	$productImage=$Pro[0]['image'];//===========================>cImage Of Product
  	$productPrice=$Pro[0]['price'];//===========================>Price Of Product
    
  	 $total=$productcount*$productPrice;//====================>Total for Each Product;
 
  	  echo"<br>";
  	 echo"<lable>$productName</lable> <img src=".'../image/'.$productImage." 'height='50px' width='50px' class='img-circle center-block'  ";//Image Of Product 
  	 echo"<br>";
  	
 echo"	<lable>Price</lable> <input type='number' name='price' value='$productPrice' disabled/>" ;//Price od product
  echo"<br>";

 echo"<lable>Count</lable><input type='number' name='count' value='$productcount' disabled/>" ;//count od product
  echo"<br>";
 

 echo"<lable>Total</lable><input type='number' name='total' value='$total' disabled/>" ;//count od product

 
  	



  	 	
   	 	
  

}


}


  ?>
  </div>
</div>

</td>
  </tr>
</table >


</div>
<script>
var exampleSocket = new WebSocket("ws://127.0.0.1:8080");
exampleSocket.onopen = function (event) {
   // exampleSocket.send("Here's some text that the server is urgently awaiting!"); 
  }

  exampleSocket.onmessage = function (event) {
    var array=event.data;
    console.log(array);
    if(array.split(",")[0]=="order"){
    var table=document.getElementById("table");
    var newrow=document.createElement("tr");
  
    var row=table.insertRow(1);
    row.setAttribute("id",array.split(",")[5])

    var newcell=document.createElement("td");
    newcell.innerHTML=array.split(",")[1];
    row.appendChild(newcell);
     var newcell=document.createElement("td");
    newcell.innerHTML=array.split(",")[2];
    row.appendChild(newcell);
     var newcell=document.createElement("td");
    newcell.innerHTML=array.split(",")[3];
    row.appendChild(newcell);
     var newcell=document.createElement("td");
    newcell.innerHTML="01228537719";
    row.appendChild(newcell);
     var newcell=document.createElement("td");
     var newbutton=document.createElement("button");
     newcell.appendChild(newbutton);
     newbutton.setAttribute("id",array.split(",")[5]);
     newbutton.setAttribute("class","btn btn-info");
    newbutton.innerHTML=array.split(",")[4];
    row.appendChild(newcell);
    newbutton.onclick=function(){
      ajax(array.split(",")[5],"processing");
      var elem = document.getElementById(this.id);
      elem.parentNode.removeChild(elem);

    }

    //  var newcell=document.createElement("td");
    // newcell.innerHTML=array.split(",")[6]+"<br>"+array.split(",")[7]+"<br>"+"<img src=array.split(',')[8]>";
    // row.appendChild(newcell);
  }
    if(array.split(",")[0]=="cancel"){
      console.log(array.split(",")[1]);
      var i=array.split(",")[1];
      
      var elem=document.getElementById(i);
      console.log(elem);
      elem.parentNode.removeChild(elem);

    }
  



    //window.reload();
    //document.getElementById("ta").value += '\n'+event.data 
  
}
 </script> 
 <?php } ?>
</body>
</html>