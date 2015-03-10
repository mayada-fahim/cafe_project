

<html>
<body>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/addcategory.js"></script>
<style>
.error{
margin-left:100px;


}
</style>

</head>
<?php
include "validateuserlogin.php";
require "main.php";
require "ORM.php";
if(!isset($_SESSION['id'])){
  header("Location:http://localhost/project/php/userlogin.php");
}
if($_SESSION['type']=="user"){
  echo "PERMISSION DENIED ";
  echo "you dont have permission to access this page";

}
else{
if(!empty($_GET['error']))
{$error=$_GET['error'];}
	
	$rules = array(
		'product'=>'required',
		'price'=>'required'
		
	);
$productcheck="";
	if(isset($_POST['submit']) and $_POST['submit']=="save")
{
	$validator = new validator();
	
	$validator->validate($_POST, $rules);
	$validator->check('Category',$_POST['Category'],"Select a Category" );
	$validator->file('ProductPicture',$_FILES['ProductPicture'] );
	$error_array=$validator->errors;
}
	
	if($_POST and empty($error_array)){
	$category=$_POST['Category'];
	$select_category=ORM::getInstance();
	$select_category->setTable('category');
	$selected_item=$select_category->select(array('name'=>$category));
	$category=$selected_item[0]['id'];
	$category_name=$selected_item[0]['name'];

	$insert_product = ORM::getInstance();
	$insert_product->setTable('products');
	$name=rename("/var/www/html/project/image/".$_FILES['ProductPicture']['name'], "/var/www/html/project/image/".$_POST['product'].".jpg");
	$value=array(
	'name' => $_POST['product'],
	'price' => $_POST['price'],
	'image'=> $_POST['product'].".jpg",
	'category_id'=> $category,
	'status'=> "available",
	
			);


	$check=$insert_product->insert($value);
	if ( $check==1)
		{#echo "aaya";
header("location:./allproducts.php");

}else{
$productcheck="Already Exist";
header("location://localhost/project/php/addproduct.php?error=".$productcheck);
}
		
		//redirct to the wanted page	

?>


<?php } else { ?>

<div class="container">
	<div id="btonDiv">
<button class="btn btn-primary pull-right" role="button" id="categorybton" onclick="addcat()">AddCategory</button>

</div><br/>
		<form method="post" action="addproduct.php"  enctype="multipart/form-data" class="form-horizontal">
		<div class="form-group">
			
		<div class="col-sm-11">
			<label class="col-sm-1 control-label">Product:</label>
				<input type="text" name="product"  placeHolder="Product Name" value="<?php if(isset($error_array))echo $_POST['product']; ?>">
					<div class="text-danger error"><?php if(isset($error))echo $error;?><?php if($_POST and isset($error_array['product']))
							 echo "<B>"."."."</B>".$error_array['product']; 
													?></div>
			</div></div>
	<div class="form-group">
			
<div class="col-sm-11">
	<label class="col-sm-1 control-label" >Price:</label>
				<input type="number" name="price" step="0.25"  min="0.25" placeHolder="Product Price" value="<?php if(isset($error_array)) echo $_POST['price']; ?>" ><div class="text-danger error">
					<?php if($_POST and isset($error_array['price'])) 
							echo "<B>"."."."</B>".$error_array['price'];
												 ?></div>			
			</div></div>	
			<div class="form-group">
			<div class="col-sm-11">	
			<label class="col-sm-1 control-label">Category:</label>
						
				<select name="Category" style="width:175px;height:30px;">
					<option>Select a Category
				<?php $select_category=ORM::getInstance();
					$select_category->setTable('category');
					$selected_item=$select_category->select(array());
					for($i=0;$i<count($selected_item);$i++) {
					
					 ?>
					
					
					<option ><?php echo $selected_item[$i]['name']; ?>
					<?php }?>
					
					</select>

					<br>
				<div class="text-danger error"><?php if($_POST and isset($error_array['Category'])) echo "<B>"."."."</B>".$error_array['Category']; ?></div>
		
</div></div>


			
			<div class="form-group">
		<label class="col-sm-1 control-label">Product Picture:</label><br>


				<input type="file" name="ProductPicture" class="col-sm-10 " ><br><br><div class="text-danger error">
					<?php if($_POST and isset($error_array['ProductPicture'])) echo "<B>"."."."</B>".$error_array['ProductPicture']; ?></div></div><br>
			
				
			<div class="row">
					<div class="col-sm-6 col-md-4 col-md-offset-2"> 
			
			<input type="submit" name="submit" value="save" class="btn btn-success ">
			<input type="reset"  value="reset"  class="btn btn-warning "></div></div>

		</form>
</div>
</body>
</html>
<?php } ?>
<?php } ?>
