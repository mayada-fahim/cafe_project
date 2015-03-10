<?php
require_once 'ORM.php';

if(isset($_GET['date1'])&&isset($_GET['date2'])&&isset($_GET['id'])){

	$date1=$_GET['date1']." "."00:00:00";
    $date2=$_GET['date2']." "."23:59:59";

     	$get=array(
     		"user_id"=>$_GET['id']
     		);
     	$obj=ORM::getInstance();
		$obj->setTable("orderss");
		$return2=$obj->selectdate($date1,$date2,$get);
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




?>