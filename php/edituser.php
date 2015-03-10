
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
//-------------------------------------

if (!empty($_GET['id'])){
	$id=$_GET['id'];
	$select_user = ORM::getInstance();
	$select_user->setTable('users');
	$selected=$select_user->select(array('id'=>$id));
	//var_dump($selected_item);
	
	$select_room=ORM::getInstance();
	$select_room->setTable('rooms');
	$selected_room=$select_room->select(array('id'=>$selected[0]['room_id']));
	
	
	}

if (!empty($_FILES['userprofilepic']['name'])){	 
		$file1=$_FILES['userprofilepic']['name'];
		$file=array('name'=>$file1,'type'=>$_FILES['userprofilepic']['type'],'tmp_name'=>$_FILES['userprofilepic']['tmp_name'],'error'=>$_FILES['userprofilepic']['error'],'size'=>$_FILES['userprofilepic']['size']);}
	elseif(!empty($_POST['pic'])){
		$file1=$_POST['pic'];
		$file=array('name'=>$file1,'type'=>"image/jpeg",'tmp_name'=>'','error'=>0,'size'=>1024000);}
	else {
		$file1=$selected[0]['image'];
		$file=array('name'=>$file1,'type'=>"image/jpeg",'tmp_name'=>'','error'=>0,'size'=>1024000);}
	$_FILES['userprofilepic']['name']=$file1;


if (!empty($_POST['mail'])){	 
		$mail=$_POST['mail'];
		}
	
	else  {
		$mail=$selected[0]['email'];
		
	}

if (!empty($_POST['id'])){	 
		$id=$_POST['id'];
		}
	
	else  {
		$id=$selected[0]['id'];
		
	}


	$rules = array(
		'username'=>'required',
		'password'=>'required',
		'confirmpassword'=>'required',
		'roomNo'=>'required',
		'question'=>'required',
		'answer'=>'required',

		
		
	);

	
	if(isset($_POST['submit']) and $_POST['submit']=="save")
	{
		$validator = new validator();
	
		$validator->validate($_POST, $rules);
		$validator->check('roomNo',$_POST['roomNo'],"" );
		$validator->file('userprofilepic',$file );
		$error_array=$validator->errors;
		
		
	}
	
	 if($_POST and empty($error_array) )

	{
	
 $name=rename("/var/www/html/project/image/".$file1, "/var/www/html/project/image/".$_POST['mail'].".jpg");
			$roomNumber =ORM::getInstance();
  			$roomNumber-> setTable("rooms");
			$roomcond=array('number'=>$_POST["roomNo"]);//Zero will convert to i
 			$roomarr=$roomNumber->select($roomcond);
 			$Room=($roomarr[0]['id']);//Zero will not convert to i =========> ROOM Number
 		
			$datauserupdate=array("username" => $_POST['username'],
							"password"=>md5($_POST['password']),
							'image'=>$_POST['mail'].".jpg",
							"type"=>"user",
							"room_id"=>$Room,
							"question"=>$_POST["question"],
							"answer"=>$_POST["answer"],
							
							'where'=>'where',
							'id'=>$_POST['id']
							
							);




$add =ORM::getInstance();
$add-> setTable("users");
$array=$add->update($datauserupdate);//no of rows that inserted

//-----------------------------------
if($array==1)

header("Location:allusers.php");






?>
<?php } else { ?>


<?php 



?>

<div class="container">

		<form method="post" action="edituser.php"  enctype="multipart/form-data">
<div class="form-group">
			
		<div class="col-sm-12">

			<label class="col-sm-1 control-label" >Name:</label>
				<input type="text" name="username" value="<?php if(isset($error_array['username']))echo $_POST['username'];
if(!empty($selected[0]['username'])) echo $selected[0]['username']; 
								else echo $_POST['username'];?>" 
		
				placeHolder="Enter username"><br>
				<div class="text-danger error">	<?php if($_POST and isset($error_array['username'])) 
						echo "<B>"."."."</B>".$error_array['username']; 

						  
											?></div>
			</div></div><br><br>
	<div class="form-group">
			
<div class="col-sm-12">
			
			<label class="col-sm-1 control-label">E-mail:</label>
				<input type="text" id="email" name="email" value="<?php if (isset($error_array['email'])) echo $_POST['email'];
if(!empty($selected[0]['email'])) echo $selected[0]['email']; 
								else echo $_POST['mail'];?>"  placeHolder="Enter Email" disabled></div></div><br><br>


			
			<div class="form-group">
			<div class="col-sm-12">
			<label class="col-sm-1 control-label">Password:</label>
				<input type="password" name="password" value="<?php if (isset($error_array['password']))echo $_POST['password'];

if(!empty($selected[0]['password'])) echo $selected[0]['password']; 
								else echo $_POST['password'];?>"  placeHolder="Enter Password"><div class="text-danger error">
					<?php if($_POST and isset($error_array['password']))
							 echo "<B>"."."."</B>".$error_array['password'];
							   
													 ?></div></div></div><br><br>


			
			<div class="form-group">
			<div class="col-sm-12">
			<label class="col-sm-1 control-label">Confirm Password:</label>
				<input type="password" name="confirmpassword" value="<?php if( isset($error_array['confirmpassword']))echo $_POST['confirmpassword'];
if(!empty($selected[0]['password'])) echo $selected[0]['password']; 
								else echo $_POST['confirmpassword'];?>" placeHolder="Enter confirmPassword"><div class="text-danger error">
					<?php if($_POST and isset($error_array['confirmpassword'])) 
						echo "<B>"."."."</B>".$error_array['confirmpassword']; 
						

													?></div></div></div><br><br>


			
			<div class="form-group">
			<div class="col-sm-12">



<label class="col-sm-1 control-label">Question:</label>
				<input type="text" name="question" value="<?php if( isset($error_array['question']))echo $_POST['question'];
if(!empty($selected[0]['question'])) echo $selected[0]['question']; 
								else echo $_POST['question'];?>" placeHolder="Enter Question"><div class="text-danger error">
					<?php if($_POST and isset($error_array['question'])) 
						echo "<B>"."."."</B>".$error_array['question']; 
						

													?></div></div></div><br><br>


			
			<div class="form-group">
			<div class="col-sm-12">

<label class="col-sm-1 control-label">Answer:</label>
				<input type="text" name="answer" value="<?php if( isset($error_array['answer']))echo $_POST['answer'];
if(!empty($selected[0]['answer'])) echo $selected[0]['answer']; 
								else echo $_POST['answer'];?>" placeHolder="Enter Answer"><div class="text-danger error">
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
		
<input type="hidden" name="pic" value="<?php if(!empty($selected[0]['image']))echo $selected[0]['image']; else echo  $file1;?>">	
			<input type="hidden" name="id" value="<?php if(!empty($selected[0]['id']))echo $selected[0]['id'];else echo $id;?>">
			<input type="hidden" name="mail" value="<?php if(!empty($selected[0]['email']))echo $selected[0]['email'];else echo $mail;?>">

			<div class="row">
					<div class="col-sm-6 col-md-4 col-md-offset-2"> 
			<input type="submit" name="submit" value="save" class="btn btn-success" >
			<input type="reset"  value="reset" class="btn btn-danger"></div></div>

		</form>
</div>

</body>
</html>
<?php } ?>
