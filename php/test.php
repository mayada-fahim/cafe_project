<label class="col-sm-1 control-label">E-mail:</label>
				<input type="text" id="email" name="email" value="<?php //if (isset($error_array['email'])) echo $_POST['email'];
 // echo "hhhh";
 // echo($_SESSION['email']);

				
 						  if(!empty($_SESSION['email'])&&!empty($_SESSION["name"]))
 						  {
 							$edit_email=$_SESSION['email'];

 		 					echo $edit_email;	
 		 					

						}

				?>" placeHolder="Enter Email"><div class="text-danger error">
<?php if(isset($error))echo $error;?><br>	
					<?php if($_POST and isset($error_array['email'])) 
						echo "<B>"."."."</B>".$error_array['email']; 
						// $_SESSION["email"] = "";
						// echo"Email seiion line 303";
						// var_dump($_SESSION['email']);
						
						  if(!empty($_SESSION["email"])&&!empty($_SESSION["name"]))
						  {
			

								$edit_email=$_SESSION["email"];
								
							
							echo '<script type="text/javascript" >
						
							 document.getElementById("email").disabled = true;
							// document.getElementById("email").innerHTML= $edit_email;

							 </script>';
							

						}
 $_SESSION["name"] = "";
 
						
					?>
								</div></div></div><br><br> 

