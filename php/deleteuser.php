
<html>
<head></head>
<body>
<?php
include "main.php";
include_once("ORM.php");
 

	$index=$_GET['id'];
	//echo $index;
	//$usercond="id=".$index;
	$user =ORM::getInstance();
 	$user-> setTable("users");
	$usercond=array( 'id'=>$index);		

 	$array=$user->delete($usercond);
 	//print_r($array);


		
// 	$img=explode(":", $all[$index])[6];
//  unset($all[$index]);
// //-----------To delete Image From Folder uploade
// unlink(trim($img));


 	header("Location: allusers.php");



?>
</body>


</html>