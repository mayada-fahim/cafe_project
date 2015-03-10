<?php
require_once 'ORM.php';

	//var_dump($_GET);
	//echo $_POST['name'];

//var_dump($_POST['data']);
$data=explode("#,", $_POST['data']);
//var_dump($data);

$my_array=array(
	'username'=>$_POST['name']
        	
        	);

        $obj=ORM::getInstance();
		$obj->setTable("users");
		$return=$obj->select($my_array);
		//var_dump($return);
		if(!empty($return)){
			
			
			foreach($return as $key=>$value){
				
				foreach($value as $key1=>$value1){
					if($key1=="id"){
						//echo $value1;
						$user_id=$value1;
						//var_dump($user_id);

					}


				}
			}
			
		}
		$my_array2=array(
	'number'=>$_POST['room']
        	
        	);

		$obj->setTable("rooms");
		$return=$obj->select($my_array2);
		//var_dump($return);
		if(!empty($return)){
			
			
			foreach($return as $key=>$value){
				
				foreach($value as $key1=>$value1){
					if($key1=="id"){
						//echo $value1;
						$room_id=$value1;
						//var_dump($room_id);

					}


				}
			}
			
		}
		$now = time();

		$order=array(
	'user_id'=>$user_id,
	'room_id'=>$room_id,
	'notes'=>$_POST['notes'],
	'total'=>$_POST['total'],
	'status'=>"processing"
        	
        	);
		


		$obj->setTable("orderss");
		$return=$obj->insert($order);
		$return2=$obj->selecto();

		if(!empty($return2)){
			
			
			foreach($return2 as $key=>$value){
				
				foreach($value as $key1=>$value1){
					//echo "here";
					if($key1=="id"){
						
						$order_id=$value1;

						//echo "hii";
						

					}


				}
			}
			
		}
 		for($i=0;$i<count($data);  $i+=2){
 			$my_product=array(
 				'name'=>$data[$i]);
 			$obj->setTable("products");
 			$return=$obj->select($my_product);
 			

 			if(!empty($return)){
			
			
 			foreach($return as $key=>$value){
				
				foreach($value as $key1=>$value1){
					if($key1=="id"){
						//echo $value1;
						$product_id=$value1;
						//var_dump($room_id);

					}


				}
			}
			
		}

$count=$data[$i+1];
if($i==count($data)-1)
{
	$count=substr($count,0,count($count)-1);
}

$order_product=array(
	'order_id'=>$order_id,
	
	'product_id'=>$product_id,
	'count'=>$count
	
        	
        	);


		$obj->setTable("order_product");
		$return=$obj->insert($order_product);

	}
$obj->setTable("orderss");
$return=$obj->selecto();

//to select product_id from order_product
// $obj1->setTable("order_product");
// $return1=$obj1->select(array('order_id'=>$return[0]['id']));
// //to select specification of product from products
// $obj2->setTable("products");
// $return2=$obj2->select(array('id'=>$return1[0]['product_id']));
$data = array();
			$data['user_id'] = $return[0]['user_id'];
			$data['date'] = $return[0]['date'];;
			$data['notes']=$return[0]['notes'];
			$data['status']=$return[0]['status'];
			$data['order_id']=$return[0]['id'];
			// $data['product']=$return2[0]['name'];//name of product
			// $data['price']=$return2[0]['price'];//price of product
			// $data['image']=$return2[0]['image'];//image of product



echo json_encode($data);



?>