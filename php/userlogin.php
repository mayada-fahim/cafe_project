<?php session_start(); 
	
	if(isset($_SESSION['id']))
	{
		echo "You are already logged in!";
		die();
	}

?>
<html>
<style>
.error {color: #FF0000;}
body { 
 background: url('bk.jpg') no-repeat fixed center; 
 -webkit-background-size: cover;
 -moz-background-size: cover;
 -o-background-size: cover;
 background-size: cover;
}
.default {
 
margin-top:100px;
float:right;
width:600px;
background-color:rgba(145, 114, 95,0.5);
}

</style>
	<head>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	</head>
	<body background="bk.jpg">




<?php
include "validateuserlogin.php";
require_once 'ORM.php';


$error="";
$flag="0";


	
	$rules = array(
		'email'=>'email',
		'password'=>'required'
		
	);
	if(isset($_POST['submit']) && $_POST['submit']=="login")
{
	
	$validator = new validator();
	
	$validator->validate($_POST, $rules);
	$error_array=$validator->errors;
}



	if($_POST and empty($error_array)){
        
        $my_array=array(
        	'email'=>$_POST['email'],
        	'password'=>md5($_POST['password'])
        	);

        $obj=ORM::getInstance();
		$obj->setTable("users");
		$return=$obj->select($my_array);
		if(!empty($return)){
			//var_dump($return);
			foreach($return as $key=>$value){
				//echo $key;
				//var_dump ($value);
				foreach($value as $key1=>$value1){

				if($key1=="id"){
					$_SESSION['id'] = $value1;
				}
				if($key1=="username"){
					$_SESSION['username'] = $value1;
				}
				if($key1=="image"){
					$_SESSION['image']=$value1;
				}
				if($key1=="type"){
					$_SESSION['type']=$value1;
				}

		
	

		}
	}
	if($_SESSION['type']=="Admin")
	{
	header("Location:http://localhost/project/php/orders.php");
	}
	else{
		header("Location:http://localhost/project/php/userhome.php");
	}

	}
	else{

		$error="wrong email or password";
		$flag="1";

	}








	

?>
<?php } if(!isset($_POST['submit']) || $flag == "1") { ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6 col-md-4 col-md-offset-4"> 
						 <div class="default">
							<div class="panel-heading" id="a" style=""> <strong class="">Login to BKAM</strong>


		<form method="post" action="userlogin.php" class="form-signin"  >

			<label>E-mail:</label>
				<input type="text" class="form-control" placeholder="Email" required autofocus name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];  ?>"><br>
					<?php if($_POST&&isset($error_array['email'])) echo "<B>"."."."</B>".$error_array['email']; ?><br>
			
			<label>Password:</label>
				<input type="password" class="form-control" placeholder="password" required autofocus name="password" value="<?php if(isset($_POST['password']))echo $_POST['password']; ?>"><br>
					<?php if($_POST&&isset($error_array['password']))echo "<B>"."."."</B>".$error_array['password']; ?><br>	


			
			 <a href="http://localhost/project/php/forgetpassword.php">Forget Password?</a> <br/><br/>
							
			
			<input type="submit"  class="btn btn-warning"  name="submit" value="login"><br/>

			<span class="text-danger"> <?php echo $error;?></span> <br>

			 


		</form>
	</div>
				</div>
			</div>
			</div>
			</div>	
	

<?php } ?>




</body>
</html>
