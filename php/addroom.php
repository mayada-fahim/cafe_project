<?php
include "validateuserlogin.php";
require "main.php";
require "ORM.php";

$rules = array(
		'roomNumber'=>'required',
		'roomExt'=>'required',
		'roomPlace'=>'required',
	);

	if(isset($_POST['submit']) and $_POST['submit']=="save")
	{
		$validator = new validator();
		$validator->validate($_POST, $rules);
		$error_array=$validator->errors;
	}

if($_POST and empty($error_array)){
$room = ORM::getInstance();
	$room->setTable('rooms');

	$array=array(
	'number' => $_POST['roomNumber'],
	'phone'=>$_POST['roomExt'],
	'place'=>$_POST['roomPlace'],  

			);
	$validRoom=" ";

	$added=$room->insert($array);
	// var_dump($added);
	if ( $added==1)
		 header("Location:orders.php");
		//echo"Done";
	else
		// echo "Invalid Data";
		$validRoom="Choose another Name";
	
}

?>
<html>
<body>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style>
.error{
margin-left:100px;


}
</style>

</head>
	<div class="container">	
	<form method="post" action="addroom.php" method='post'>
	  <div class="form-group">
			
		<div class="col-sm-11">
		<label  class="col-sm-1 control-label">Room Number:</label>
		<input type="text" name="roomNumber" value="<?php if(isset($error_array['roomNumber']))echo $_POST['roomNumber'];?>"  											 >
	<div class="text-danger error"><?php    if(isset($validRoom)) echo	$validRoom;?>
				<?php if($_POST and isset($error_array['roomNumber']))
					 echo "<B>"."."."</B>".$error_array['roomNumber']; 

											?></div></div></div>

<div class="form-group">
			
		<div class="col-sm-11">
<label class="col-sm-1 control-label">Room Ext:</label>
		<input type="text" name="roomExt" value="<?php if(isset($error_array['roomExt']))echo $_POST['roomExt'];?>" 											class="form-control1" id="exampleInputEmail1 inputError1">

	<div class="text-danger error">			<?php if($_POST and isset($error_array['roomExt']))
					 echo "<B>"."."."</B>".$error_array['roomExt']; 
											?></div></div></div>

<div class="form-group">
			
		<div class="col-sm-11">
<label for="exampleInputCategory">Room Place:</label>
		<input type="text" name="roomPlace" value="<?php if(isset($error_array['roomPlace']))echo $_POST['roomPlace'];?>" 											class="form-control1" id="exampleInputEmail1 inputError1">

	<div class="text-danger error">	<?php if($_POST and isset($error_array['roomPlace']))
					 echo "<B>"."."."</B>".$error_array['roomPlace']; 
											?></div></div></div>

	<div class="row">
					<div class="col-sm-6 col-md-4 col-md-offset-3"> 
		<input type='submit' name ="submit" value="save" class="btn btn-success"></div></div>
	<form>
	</div>
</body>
</html>
