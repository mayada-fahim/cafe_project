<?php
include  "ORM.php";


$id=$_POST['id'];

 $status1=$_POST['status'];

$all =ORM::getInstance();
 $all-> setTable("orderss");
 $array=$all->select(array('id'=>$id));
 //To Select Action of Order
$status=$array[0]['status'];
if($status=='processing')
{
$change_status="Done";

}
else{
$change_status="processing";
}



$update_status = ORM::getInstance();
 $update_status->setTable('orderss');
 
$value=array('status'=>$change_status,'where'=>'where','id'=>$id);
$update_status->update($value);


 echo $status.','.$id;
	//header("Location: orders.php");
?> 