<?php 
include 'ORM.php';
$cat=$_POST['cat'];


$insert_cat = ORM::getInstance();
	$insert_cat->setTable('category');

	$value=array(
	'name' => $cat,

			);

	$check=$insert_cat->insert($value);
	if ($cat and  $check)
	echo "done"; 
	else 
	echo "fail";
		



?>


