<?php
include "validateuserlogin.php";

require "ORM.php";

$rules = array(
		'mail'=>'required',
		'question'=>'required',
		'answer'=>'required'
		
	);


if(isset($_POST['submit']) and $_POST['submit']=="continue" )
{
	$validator = new validator();
	$validator->validate($_POST, $rules);
	$error_array=$validator->errors;


$select_mail=ORM::getInstance();
	$select_mail->setTable('users');
	$selected_mail=$select_mail->select(array('email'=>$_POST['mail']));

$error=array();
//var_dump($selected_mail);
//var_dump($error_array['mail']);
if(empty($error_array['mail'])){
if( !empty($selected_mail[0]['email']) and $selected_mail[0]['email']==$_POST['mail'] )
{
	if($selected_mail[0]['question']==$_POST['question'])
		{
			if($selected_mail[0]['answer']==$_POST['answer'])

				{

					header("Location:http://localhost/project/php/newpassword.php?id=".$selected_mail[0]['id']);

				}
			else{
				$error['answer']="wrong answer";

				}


		}
	else
	{
		$error['question']="wrong question";

	}


}
else{


$error['mail']="wrong mail";
}

}
}

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
 margin-top:30px;
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
							<div class="panel-heading" id="a" style=""> <strong class="">Forget Password</strong><br>

<form method="post" action="forgetpassword.php">

<label >E-mail:</label>
<input type="text" class="form-control" name="mail" placeholder="Enter your email"><br>
<?php if($_POST and isset($error_array['mail']))
							 echo "<B>"."."."</B>".$error_array['mail']; 
													?>
<?php if( isset($error) and isset($error['mail'])) echo ".".$error['mail'];?><br>

<label >Question:</label>

<input type="text"  class="form-control" name="question" placeholder="Enter the question"><br>

<?php if($_POST and isset($error_array['question']))
							 echo "<B>"."."."</B>".$error_array['question']; 
													?>
<?php if( isset($error) and isset($error['question'])) echo ".".$error['question'];?><br>

<label >Answer:</label>
<input type="text" class="form-control" name="answer" placeholder="Enter the answer "><br>

<?php if($_POST and isset($error_array['answer']))
							 echo "<B>"."."."</B>".$error_array['answer']; 
													?>
<?php if( isset($error) and isset($error['answer'])) echo ".".$error['answer'];?><br>

<div class="centered">
<center><input type="submit" name="submit" value="continue" class="btn btn-success"></center></div>
</div>
</form>

</div>
				</div>
			</div>
			</div>
			</div>	
</body>
</html>

