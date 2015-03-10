<?php 

require "ORM.php";
//require_once "mainuser.php";
	// To get date from the calender onkeyup
	$startDate1=$_POST['start'];
	$endDate1=$_POST['end'];
	if(!empty($_POST['start']) && !empty($_POST['end'])){
	
	$startDate=$startDate1.' '.'00:00:00';
	$endDate=$endDate1.' '.'23:59:59';

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
	
	$select_date = ORM::getInstance();
	$select_date->setTable('orderss');
	$selected_date=$select_date->selectdate1($startDate,$endDate);
session_start();	


	// This is to select related user within this date 
	for($date=0;$date<count($selected_date);$date++){

		if($selected_date[$date]['user_id']==$_SESSION['id']) { //user id will come from user_session
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
						
		

$myorder_send='';
for($i=0;$i<count($myorder);$i++){
	foreach($myorder[$i] as $key=>$value){
		if($key ==  end( array_keys( $myorder[$i] ) ) ){
			$myorder_send=$myorder_send.$value;
		}
		else{
			$myorder_send=$myorder_send.$value.',';
			}

		}
	if($i==count($myorder)-1){
		$myorder_send=$myorder_send;
		}
	else{
		$myorder_send=$myorder_send.'#';

	}
	}
if($startDate1 and $endDate1 and empty($arrayDate[0])){
echo "error";
			}
else if($startDate1 and $endDate1 and $arrayDate[0]){

echo $myorder_send;
}

}


?>









