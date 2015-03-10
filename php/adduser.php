
<html>
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

<body>

<?php

include "validateuserlogin.php";
include "main.php";
include_once( "ORM.php");
if(!isset($_SESSION['id'])){
  header("Location:http://localhost/project/php/userlogin.php");
}
if($_SESSION['type']=="user"){
  echo "PERMISSION DENIED ";
  echo "you dont have permission to access this page";

}
else{
//-------------------------------------
 if(!empty($_GET['error']))
{
$error=$_GET['error'];
}


	$rules = array(
		'username'=>'required',
		'email'=>'email',
		'password'=>'required',
		'confirmpassword'=>'required',
		'roomNo'=>'required',
		'question'=>'required',
		'answer'=>'required',

		
		
	);
$validEmail=" ";
	
	if(isset($_POST['submit']) and $_POST['submit']=="save")
	{
		$validator = new validator();
	
		$validator->validate($_POST, $rules);
		$validator->check('roomNo',$_POST['roomNo'],"" );
		$validator->file('userprofilepic',$_FILES['userprofilepic'] );
		$error_array=$validator->errors;
		
		
	}
	
	 if($_POST and empty($error_array) )

	{
	
 $name=rename("/var/www/html/project/image/".$_FILES['userprofilepic']['name'], "/var/www/html/project/image/".$_POST['email'].".jpg");
			$roomNumber =ORM::getInstance();
  			$roomNumber-> setTable("rooms");
			$roomcond=array('number'=>$_POST["roomNo"]);//Zero will convert to i
 			$roomarr=$roomNumber->select($roomcond);
 			$Room=($roomarr[0]['id']);//Zero will not convert to i =========> ROOM Number
 		
			$datauserinsert=array("username" => $_POST['username'],
							"password"=>md5($_POST['password']),
							'image'=>$_POST['email'].".jpg",
							"type"=>"user",
							"room_id"=>$Room,
							"question"=>$_POST["question"],
							"answer"=>$_POST["answer"],
							"email" =>$_POST["email"],
							
							);




$add =ORM::getInstance();
$add-> setTable("users");
$array=$add->insert($datauserinsert);//no of rows that inserted

//-----------------------------------
if($array!=1)
{
$validEmail="Email already Exist choose another one";
header("Location:adduser.php?error=".$validEmail);
}
else{
header("Location:allusers.php");

}





				










?>
<?php } else { ?>


<?php 



?>

<div class="container">

		<form method="post" action="adduser.php"  enctype="multipart/form-data">
<div class="form-group">
			
		<div class="col-sm-12">

			<label class="col-sm-1 control-label" >Name:</label>
				<input type="text" name="username" value="<?php if(isset($error_array))echo $_POST['username'];
				?>" placeHolder="Enter username"><br>
				<div class="text-danger error">	<?php if($_POST and isset($error_array['username'])) 
						echo "<B>"."."."</B>".$error_array['username']; 

						  
											?></div>
			</div></div><br><br>
	<div class="form-group">
			
<div class="col-sm-12">
			
			<label class="col-sm-1 control-label">E-mail:</label>
				<input type="text" id="email" name="email" value="<?php if (isset($error_array)) echo $_POST['email'];


				
		 	

								
							
							

				?>" placeHolder="Enter Email"><div class="text-danger error">
<?php if(isset($error))echo $error;?><br>	
					<?php if($_POST and isset($error_array['email'])) 
						echo "<B>"."."."</B>".$error_array['email']; 
						
						

						
					?>
											</div></div></div><br><br>


			
			<div class="form-group">
			<div class="col-sm-12">
			<label class="col-sm-1 control-label">Password:</label>
				<input type="password" name="password" value="<?php if (isset($error_array))echo $_POST['password'];


				?>" placeHolder="Enter Password"><div class="text-danger error">
					<?php if($_POST and isset($error_array['password']))
							 echo "<B>"."."."</B>".$error_array['password'];
							   
													 ?></div></div></div><br><br>


			
			<div class="form-group">
			<div class="col-sm-12">
			<label class="col-sm-1 control-label">Confirm Password:</label>
				<input type="password" name="confirmpassword" value="<?php if( isset($error_array))echo $_POST['confirmpassword'];

					  
				?>" placeHolder="Enter confirmPassword"><div class="text-danger error">
					<?php if($_POST and isset($error_array['confirmpassword'])) 
						echo "<B>"."."."</B>".$error_array['confirmpassword']; 
						

													?></div></div></div><br><br>


			
			<div class="form-group">
			<div class="col-sm-12">



<label class="col-sm-1 control-label">Question:</label>
				<input type="text" name="question" value="<?php if( isset($error_array))echo $_POST['question'];

					
				?>" placeHolder="Enter Question"><div class="text-danger error">
					<?php if($_POST and isset($error_array['question'])) 
						echo "<B>"."."."</B>".$error_array['question']; 
						

													?></div></div></div><br><br>


			
			<div class="form-group">
			<div class="col-sm-12">

<label class="col-sm-1 control-label">Answer:</label>
				<input type="text" name="answer" value="<?php if( isset($error_array))echo $_POST['answer'];

					  
				?>" placeHolder="Enter Answer"><div class="text-danger error">
					<?php if($_POST and isset($error_array['answer'])) 
						echo "<B>"."."."</B>".$error_array['answer']; 
						

													?></div></div></div><br><br>


			
			<div class="form-group">
			<div class="col-sm-12">



			<label class="col-sm-1 control-label">Room No.:</label>
	

		 


			


	<select name="roomNo" id="room_comb" style='width:175px;'>
			<option>
				<?php $select_Room=ORM::getInstance();
					$select_Room->setTable('rooms');
					$selected_item=$select_Room->select(array());
					for($i=0;$i<count($selected_item);$i++) {
						
					
					 ?>
					
					
					<option ><?php echo $selected_item[$i]['number']; ?>
					<?php }?>
					
					</select>
					
			<div class="text-danger error">		<?php if($_POST and isset($error_array['roomNo'])) 
								echo "<B>"."."."</B>".$error_array['roomNo']; 
									?></div></div></div><br><br>


			
			<div class="form-group">
			<div class="col-sm-12">
	

			<label class="col-sm-1 control-label">Profile Picture:</label><br>
				<input type="file" name="userprofilepic" class="col-sm-10 " ><br><br>
			<div class="text-danger error">		<?php if($_FILES and isset($error_array['userprofilepic'])) 
						echo "<B>"."."."</B>".$error_array['userprofilepic'];
			
												 ?></div></div></div><br><br>
		


			<div class="row">
					<div class="col-sm-6 col-md-4 col-md-offset-2"> 
			<input type="submit" name="submit" value="save" class="btn btn-success" >
			<input type="reset"  value="reset" class="btn btn-danger"></div></div>

		</form>
</div>

</body>
</html>
<?php } ?>
<?php }?>
