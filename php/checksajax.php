<?php
require_once 'ORM.php';

     if(isset($_GET['date1'])&&isset($_GET['date2'])){
     	//echo $_GET['date1']." ".$_GET['date2'];
     	$date1=$_GET['date1']." "."00:00:00";
     	$date2=$_GET['date2']." "."23:59:59";

     	$obj=ORM::getInstance();
		$obj->setTable("orderss");
		$return=$obj->aggregate($date1,$date2);
		//print json_encode($return);
		//var_dump($return);

		 if(!empty($return)){
			
		 	$user_id=array();
		 	foreach($return as $key=>$value){
				
		 		foreach($value as $key1=>$value1){
		 			//echo ($key1);
		 			if($key1=="user_id"){
		 				//echo $value1;
						
		 				$user_id[]=$value1;

					
						
		 			}

		 			if($key1=="sum(total)"){
		 				$prices[]=$value1;
		 			}


		 		}
		 	}
		// 	//var_dump($user_id);
			$obj->setTable("users");
			$users=array();

			for($j=0;$j<count($user_id);$j++){
				$my_array=array(
					'id'=>$user_id[$j]	
					);
				$return2=$obj->select($my_array);
				foreach($return2 as $key=>$value){
				
				foreach($value as $key1=>$value1){
					//echo $key1;
					if($key1=="username"){
						//echo $value1;
						
						$users[]=$value1;
					
					
						
					}


				}
			}

			}
			$data = array();
			$data['users'] = $users;
			$data['prices'] = $prices;
			$data['id']=$user_id;
		echo json_encode($data);

		
		

		//var_dump($arr);

			
			
		}
		else{
			echo json_encode($return);
		}
	}
		

 if(isset($_GET['id'])){
 	//echo "helloo";
 	//$date1=$_GET['date1']." "."00:00:00";
    //$date2=$_GET['date2']." "."23:59:59";

     	$get=array(
     		"user_id"=>$_GET['id']
     		);
     	$obj=ORM::getInstance();
		$obj->setTable("orderss");
		$return2=$obj->select($get);
		if(!empty($return2)){
			
		 	$date=array();
		 	foreach($return2 as $key=>$value){
				
		 		foreach($value as $key1=>$value1){
		 			//echo ($key1);
		 			if($key1=="date"){
		 				//echo $value1;
						
		 				$date[]=$value1;

					
						
		 			}

		 			if($key1=="total"){
		 				$price[]=$value1;
		 			}
		 			if($key1=="id"){
		 				$idd[]=$value1;
		 			}


		 		}
		 	}
		 	$data1= array();
			$data1['dates'] = $date;
			$data1['price'] = $price;
			$data1['idd'] = $idd;
			
		echo json_encode($data1);


     	
     }
 }


 if(isset($_GET['idd'])){
 	$get1=array(
     		"order_id"=>$_GET['idd']
     		);
 	$obj=ORM::getInstance();
	$obj->setTable("order_product");
	$return3=$obj->select($get1);
	//var_dump($return3);
	if(!empty($return3))
	{
			
		 	$product_id=array();
		 	foreach($return3 as $key=>$value){
				
		 		foreach($value as $key1=>$value1){
		 			//echo ($key1);
		 			if($key1=="product_id"){
		 				//echo $value1;
						
		 				$product_id[]=$value1;

					
						
		 			}

		 			if($key1=="count"){
		 				$count[]=$value1;
		 			}
		 			


		 		}
		 	}

 	}
 	$obj->setTable("products");
 	for($i=0;$i<count($product_id);$i++)
 	{
 		$select=array(
 			'id'=>$product_id[$i]
 			);
 		$r=$obj->select($select);
 		//var_dump($r);
 		if(!empty($r))
		{
			
		 	
		 	foreach($r as $key=>$value)
		 	{
				
		 		foreach($value as $key1=>$value1)
		 		{
		 			//echo ($key1);
		 			if($key1=="name"){
		 				//echo $value1;
						
		 				$name[]=$value1;

					
						
		 			}

		 			if($key1=="price"){
		 				$p[]=$value1;
		 			}
		 			if($key1=="image"){
		 				$images[]=$value1;
		 			}
		 			


		 		}
		 	}

 	}
}

$data2 = array();
			$data2['count'] = $count;
			$data2['name'] = $name;
			$data2['p'] = $p;
			$data2['images']=$images;
			
		echo json_encode($data2);
}

?>