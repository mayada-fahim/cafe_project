<?php

include "validateuserlogin.php";
include "main.php";
	$rules = array(
		'username'=>'required',
		'email'=>'email',
		'password'=>'required',
		'confirmpassword'=>'required',
		
		'roomNo'=>'required',
		'ext'=>'required'
		
	);
	
	if(isset($_POST['submit']) and $_POST['submit']=="save")
	{
		$validator = new validator();
	
		$validator->validate($_POST, $rules);
		$validator->file('userprofilepic',$_FILES['userprofilepic'] );
		$error_array=$validator->errors;
	}	
	
	if($_POST and empty($error_array) ){

	echo "aya";


?>
<?php } else { ?>
<html>
<body>
<a href="home">Home</a>&nbsp;&nbsp;
<a href="product">Product</a>&nbsp;&nbsp;
<a href="Users">User</a>&nbsp;&nbsp;
<a href="manual">ManualOrder</a>&nbsp;&nbsp;
<a href="Check">Check</a>
		<form method="post" action="adduser.php"  enctype="multipart/form-data">
			<label>Name</label>
				<input type="text" name="username" value="<?php if(isset($error_array['username']))echo $_POST['username'];?>"><br>
					<?php if($_POST and isset($error_array['username'])) 
						echo "<B>"."."."</B>".$error_array['username']; 
											?><br>
			
			<label>E-mail</label>
				<input type="text" name="email" value="<?php if (isset($error_array['email'])) echo $_POST['email'];?>"><br>	
					<?php if($_POST and isset($error_array['email'])) 
						echo "<B>"."."."</B>".$error_array['email']; 
											?><br>
					
			
			<label>Password</label>
				<input type="password" name="password" value="<?php if (isset($error_array['password']))echo $_POST['password'];?>"><br>
					<?php if($_POST and isset($error_array['password']))
							 echo "<B>"."."."</B>".$error_array['password'];
													 ?><br>

			<label>Confirm Password</label>
				<input type="password" name="confirmpassword" value="<?php if( isset($error_array['confirmpassword']))echo $_POST['confirmpassword'];?>"><br>
					<?php if($_POST and isset($error_array['confirmpassword'])) 
						echo "<B>"."."."</B>".$error_array['confirmpassword']; 
													?><br>

			<label>Room No.</label>
				<input type="text" name="roomNo" value="<?php if(isset($error_array['roomNo']))echo $_POST['roomNo'];?>"><br>
					<?php if($_POST and isset($error_array['roomNo'])) 
								echo "<B>"."."."</B>".$error_array['roomNo']; 
													?><br>
		
			<label>Ext.</label>
				<input type="text" name="ext" value="<?php if(isset($error_array['ext']))echo $_POST['ext'];?>"><br>
					<?php if($_POST and isset($error_array['ext'])) 
						echo "<B>"."."."</B>".$error_array['ext']; 
											?><br>

			<label>Profile Picture</label>
				<input type="file" name="userprofilepic" ><br>
					<?php if($_FILES and isset($error_array['userprofilepic'])) 
						echo "<B>"."."."</B>".$error_array['userprofilepic'];
												 ?><br>

			<input type="submit" name="submit" value="save">
			<input type="reset"  value="reset">

		</form>

</body>
</html>
<?php } ?>
