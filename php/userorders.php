<html>
<style>
.topp{
	margin-top:23px; 
}
</style>
	<body>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
			<link rel="stylesheet" href="style.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="../js/date.js"></script>
			<script type="text/javascript" src="../js/polyfiller.js"></script>
			<script type="text/javascript" src="../js/modernizr-custom.js"></script>
		</head>
<?php


require "ORM.php";
include "mainuser.php";
if(!isset($_SESSION['id'])){
	header("Location:http://localhost/project/php/userlogin.php");
}
if($_SESSION['type']=="Admin"){
	echo "PERMISSION DENIED you dont have permission to access this page ";
}
else{
	// To get date from the calender onkeyup
$totalPrice=0;	

	$arrayOrder=array();//to save order id from orderss table
	$arrayDate=array();//to save selected date
	$arrayStatus=array();//to save status from orderss table
	$arraySelectedProduct=array();//to get all selected order from table order_product
	$allProducts=array();//to get all selected product id from table order_product
	$productInfo=array();//to save price and image for each product

	$order_amount=array();//to save amount according to each order
	$order_image=array();//to save image according to each order
	$myorder=array();// to save the displayed order
	$order_price=array();//tosave price of product according to order
	$order_name=array();// to save name of product of each order
	$order_count=array();//to save amount of product of each order
	$arrayId=array();

	//to select rows  between Selected date
	
	//$select_date = ORM::getInstance();
	//$select_date->setTable('orderss');
	//$selected_date=$select_date->selectdate($startDate,$endDate);
	


	// This is to select related user within this date 


	$select_date = ORM::getInstance();
	$select_date->setTable('orderss');
	
	$id= $_SESSION['id'];
	$selected_date=$select_date->select(array('user_id'=>$id));// user_id from session

	for($date=0;$date<count($selected_date);$date++){

		if($selected_date[$date]['user_id']==1) { //user id will come from user_session
			$arrayOrder[]=$selected_date[$date]['id'];
			$arrayStatus[]=$selected_date[$date]['status'];
			$arrayDate[]=$selected_date[$date]['date'];
			$arrayId[]=$selected_date[$date]['id'];

							}
			}

		

	// From table of order_product we select all record where order id are selected from table orderss for specific user
	
	$select_order= ORM::getInstance();
	$select_order->setTable('order_product');

	foreach($arrayOrder as $order){

		$arraySelectedProduct[]=$select_order->select(array('order_id'=>$order));
	

						}
	// To get product id 
		foreach($arraySelectedProduct as $products){

			foreach($products as $product){

				$allProducts[]=$product['product_id'];
							}
								}
				$distinct_product = array_unique($allProducts);//to remove duplicate product id
	
	

	
	// From table of products we select all record where product id are selected from table order_product for specific product
	

	$select_product= ORM::getInstance();
	$select_product->setTable('products');

	foreach($distinct_product as $oneproduct){

		$productInfo[]=$select_product->select(array('id'=>$oneproduct));
					}
	

	// to get total amount for each order
	foreach($arraySelectedProduct as $orders){
		$total=0;
		$image="";
		$price='';
		$name='';
		$count='';
		foreach($orders as $order){
		
			foreach($productInfo as $products){
				foreach($products as $product){
				if($order['product_id']==$product['id']){
					$total=$total+($order['count']*$product['price']);
					$image=$image.$product['image'].'@';
				

					$price=$price.$product['price'].'|';
					$name=$name.$product['name'].'*';
					$count=$count.$order['count'].'&';
								
					}
		}
			
			}

				}
		$order_image[]=substr($image, 0, -1);
		$order_amount[]=$total;
		$order_price[]=substr($price, 0, -1);
		$order_name[]=substr($name, 0, -1);
		$order_count[]=substr($count, 0, -1);
					}
	

// to save the date related to status related to amount related to image 
	for ($i=0;$i<count($order_image);$i++)
	{

		$myorder[]=array("date"=>$arrayDate[$i],'status'=>$arrayStatus[$i],'amount'=>$order_amount[$i],'image'=>$order_image[$i],'price'=>$order_price[$i],'name'=>$order_name[$i],'count'=>$order_count[$i],'id'=>$arrayId[$i]);
	


					}





 ?>


	<div class="container">
		<h2><span class="glyphicon glyphicon-check"></span>	My Orders</h2><br>

<div class="row">
        	<div class='col-sm-5'>
            	<div class="form-group">
            		<label> From:</label>
<div class='input-group date' id='datetimepicker1'>

<input type="date"  id="start" class="form-control" placeHolder="mm-dd-yyyy" >
<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    		</span>
                		</div>
</div>
        	</div>
        	<div class='col-sm-5'>
        		<div class="form-group">
            		<label> To:</label>

                		<div class='input-group date' id='datetimepicker1'>

<input type="date" id="end"  class="form-control" placeHolder="mm-dd-yyyy" >

<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    		</span>
                		</div>
            	</div>
        	</div>
        	<div class='col-sm-2'>
        		<div class="form-group">

<input type="submit" class="btn btn-success topp" value="Get orders" onclick="ajax()">
</div>
</div>
        	</div>	
      

		<table id='ordertable' class="table table-striped">
			<tbody>
			<tr>
				<th>Orderdate</th>
				<th>Status</th>
				<th>Amount</th>
				<th>Action</th>
			</tr>

	<?php for($i=0 ;$i<count($myorder);$i++){ ?>
		<tr id="<?php echo $i ;?>">
			<td>
		<button value="<?php echo $i;?>" 
			class="oldbutton"
			id="<?php echo "zorar".$myorder[$i]['id']; ?>" 
			name="<?php echo $myorder[$i]['image'].'$'.$myorder[$i]['price'].'$'.$myorder[$i]['name'].'$'.$myorder[$i]['count'];?>"onclick='check(this.value,this.name,this.id)'>
	
				+</button>
		<?php echo $myorder[$i]['date']; ?>
			</td>
<?php $totalPrice=$totalPrice+$myorder[$i]['amount'];?>
			<td><?php echo $myorder[$i]['status'];?></td>
			<td><?php echo $myorder[$i]['amount'];?></td>

			<td>
				<?php if($myorder[$i]['status']=='processing'){?> <button name="<?php echo $i;?>"class="btn btn-warning" id="<?php echo 'btn'.$myorder[$i]['id']; ?>" onclick="cancel(this.id,this.name)">cancel</button><?php }?>
			</td>
		</tr>
<?php } ?>
</tbody>
		</table>
<span style='float:right;' id='span'>
<div class="label label-primary">
<?php echo "EGP".$totalPrice;?>
</div>
</span>
</div>




	<?php }?>

	

	</body>
</html>
