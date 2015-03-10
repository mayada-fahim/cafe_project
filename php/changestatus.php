<?php
include "ORM.php";
//echo "hello";

$id=$_POST['id'];

$status1=$_POST['status'];


$select_status = ORM::getInstance();
 $select_status->setTable('products');
$value=array('id'=>$id);
$selected_status=$select_status->select($value);
//var_dump($selected_status);
$status=$selected_status[0]['status'];

if($status=='available')
{
$change_status="unavailable";

}
else{
$change_status="available";

}

$update_status = ORM::getInstance();
 $update_status->setTable('products');
$value=array('status'=>$change_status,'where'=>'where','id'=>$id);
$update_status->update($value);


echo $status.','.$id;

?>
