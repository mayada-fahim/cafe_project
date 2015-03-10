<?php 
require "ORM.php";
$id=$_GET['id'];

$select_id=ORM::getInstance();
	$select_id->setTable('users');
	$selected_id=$select_id->select(array('id'=>$id));


$chars = '0123456789abcde'; 
$randomString = '';
 for ($i = 0; $i < 5; $i++) {
 $randomString .= $chars[rand(0, strlen($chars)-1)]; 
		}








$update_password = ORM::getInstance();
	$update_password->setTable('users');
	
	$value=array(
	'password' => md5($selected_id[0]['password']),
	'where'=>'where',
	'id'=>$id
	
			);

$check=$update_password->update($value);










?>



<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/addcategory.js"></script>
<style>
.panel-default {
 opacity: 0.9;
 margin-top:170px;
}
body { 
 background: url('.jpg') no-repeat center center fixed; 
 -webkit-background-size: cover;
 -moz-background-size: cover;
 -o-background-size: cover;
 background-size: cover;
}
</style>

</head>
<body>
<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-4 col-md-offset-4"> 
						 <div class="panel panel-default">
							<div class="panel-heading" id="a" style=""> <strong class="">Your NewPassword</strong><br>


	 <?php echo "Hello ".$selected_id[0]['username']."<br>"." Your new password is  "."<br>".$randomString;?>


</div>
				</div>
			</div>
			</div>
			</div>	
</body>
</html>
