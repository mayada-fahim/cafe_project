<?php
include "ORM.php";
$date=$_POST['param'];//to get date of order
$row=$_POST['row'];//to get row

	$select_date = ORM::getInstance();
	$select_date->setTable('orderss');
	$selected_date=$select_date->select(array('id'=>$date));

//$order_id=$selected_date[0]['id'];






	$delete_row = ORM::getInstance();
	$delete_row->setTable('orderss');
	$delte_order=$delete_row->delete(array('id'=>$date));

	$delete_row = ORM::getInstance();
	$delete_row->setTable('order_product');
	$delte_order=$delete_row->delete(array('order_id'=>$date));
	

//echo $date;
echo $row;







?>
