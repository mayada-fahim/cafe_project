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
	if (!empty($_GET['id'])){
	$id=$_GET['id'];
	$select_product = ORM::getInstance();
	$select_product->setTable('products');
	$selected=$select_product->select(array('id'=>$id));
	//var_dump($selected_item);
	
	$select_category=ORM::getInstance();
	$select_category->setTable('category');
	$selected_cat=$select_category->select(array('id'=>$selected[0]['category_id']));
	
	
	}
	if (!empty($_FILES['ProductPicture']['name'])){	 
		$file1=$_FILES['ProductPicture']['name'];
		$file=array('name'=>$file1,'type'=>$_FILES['ProductPicture']['type'],'tmp_name'=>$_FILES['ProductPicture']['tmp_name'],'error'=>$_FILES['ProductPicture']['error'],'size'=>$_FILES['ProductPicture']['size']);}
	elseif(!empty($_POST['pic'])){
		$file1=$_POST['pic'];
		$file=array('name'=>$file1,'type'=>"image/jpeg",'tmp_name'=>'','error'=>0,'size'=>1024000);}
	else {
		$file1=$selected[0]['image'];
		$file=array('name'=>$file1,'type'=>"image/jpeg",'tmp_name'=>'','error'=>0,'size'=>1024000);}
	$_FILES['ProductPicture']['name']=$file1;
	$rules = array(
		'product'=>'required',
		'price'=>'required'
		
	);
	

	if(isset($_POST['submit']) and $_POST['submit']=="save")
{
	$validator = new validator();
	
	$validator->validate($_POST, $rules);
	$validator->check('Category',$_POST['Category'],"Select a Category" );
	$validator->file('ProductPicture',$file );
	$error_array=$validator->errors;
}
	//echo $file1;
	if($_POST and empty($error_array)){
	$category=$_POST['Category'];
	$select_category=ORM::getInstance();
	$select_category->setTable('category');
	$selected_item=$select_category->select(array('name'=>$category));
	$category=$selected_item[0]['id'];


	$select_id=ORM::getInstance();
	$select_id->setTable('products');
	$selected_id=$select_id->select(array('id'=>$_POST['id']));
	$product=$selected_id[0]['name'];
		


	$update_product = ORM::getInstance();
	$update_product->setTable('products');
	$name=rename("/var/www/html/project/image/".$file1, "/var/www/html/project/image/".$_POST['product'].".jpg");
	$value=array(
	'name' => $_POST['product'],
	'price' => $_POST['price'],
	'image'=> $_POST['product'].".jpg",
	'category_id'=> $category,
	'status'=> $selected_id[0]['status'],
	'where'=>'where',
	'id'=>$_POST['id']
	
			);
//var_dump($value);


	$check=$update_product->update($value);	
		header("Location: http://localhost/project/php/allproducts.php");
	

?>

<?php } else { ?>
<!-- <html>
<body>
 --><!-- <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style>
.error{
margin-left:90px;


}
</style>

</head>
 -->
<div class="container">
		<form method="post" action="editproduct.php"  enctype="multipart/form-data" class="form-horizontal">
		
<div class="form-group">
			
		<div class="col-sm-11">
			
		<label class="col-sm-1 control-label">Product:</label>

				<input type="text" name="product" value="<?php if(isset($error_array['product']))
								echo $_POST['product'];
								if(!empty($selected[0]['name'])) echo $selected[0]['name']; 
								else echo $_POST['product'];?>" ><div class="text-danger error">
					<?php if($_POST and isset($error_array['product']))
							 echo "<B>"."."."</B>".$error_array['product']; 
													?></div>
	</div></div>
<div class="form-group">
			
<div class="col-sm-11">
			<label class="col-sm-1 control-label">Price:</label>

				<input type="number" name="price" step="0.25" value="<?php if(isset($error_array['price'])) 
									echo $_POST['price'];
									if(!empty($selected[0]['price']))
									echo $selected[0]['price'];  
									else echo $_POST['price'];	 ?>"><div class="text-danger error">
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

					
					<div class="text-danger error"><?php if($_POST) echo "<B>"."."."</B>".$error_array['Category']; ?>
		</div></div></div>

		<div class="form-group">	
<div class="col-sm-11">
			<!--<img src="<?php echo $selected[0]['image']; ?>" height="30px" width="30px" ><br>-->
			<label class="col-sm-1 control-label">Product Picture:</label><br>
				<input type="file" name="ProductPicture" class="col-sm-10 " >
				<div class="text-danger error">	<?php if($_POST and isset($error_array['ProductPicture'])) echo "<B>"."."."</B>".$error_array['ProductPicture']; ?></div></div></div>
			
				

<input type="hidden" name="pic" value="<?php if(!empty($selected[0]['image']))echo $selected[0]['image']; else echo  $file1;?>">	
			<input type="hidden" name="id" value="<?php echo $id?>">

	
			<div class="row">
					<div class="col-sm-6 col-md-4 col-md-offset-2"> 
			<input type="submit" name="submit" value="save" class="btn btn-success ">
			<input type="reset"  value="reset"class="btn btn-warning " ></div></div>


		</form>
</div>
<?php } ?>

</body>
</html>
<?php } ?>





