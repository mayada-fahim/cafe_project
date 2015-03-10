<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/status1.js"></script>

</head>
<body>
<?php
include "main.php";
include "ORM.php";
if(!isset($_SESSION['id'])){
  header("Location:http://localhost/project/php/userlogin.php");
}
if($_SESSION['type']=="user"){
  echo "PERMISSION DENIED ";
  echo "you dont have permission to access this page";

}
else{
	

	$select_products=ORM::getInstance();
	$select_products->setTable('products');
	$selected_items=$select_products->select(array());
	


?>








<div class="container">
	<h2><span class="glyphicon glyphicon-check"></span>	All Products</h2>
<a href="/project/php/addproduct.php"  class="btn btn-primary pull-right"  role="button" >Add Product</a>
<table  class="table table-bordered  table-striped text-center top">
<th><center>Product</th>
<th><center>Price</th>
<th><center>Image</th>
<th><center>status</th>
<th><center>edit</th>

<?php for($item=0;$item<count($selected_items);$item++){ ?>
<tr>
<td><?php echo $selected_items[$item]['name']; ?></td>
<td><?php echo $selected_items[$item]['price']; ?></td>
<td><img src="../image/<?php echo $selected_items[$item]['image']; ?>"height="30px" width="30px"class="img-rounded " ></td>



<td><!--<a href="<?php echo $selected_items[$item]['status']; ?>"class="btn btn-info" role="button"><?php echo $selected_items[$item]['status']; ?></a>-->




<input type="submit" id="<?php echo $selected_items[$item]['id']?>" class="btn btn-warning" value="<?php echo $selected_items[$item]['status']?>" onclick="ajax(<?php echo $selected_items[$item]['id']?>,'<?php echo $selected_items[$item]['status']?>')">









<td><a href=" /project/php/editproduct.php/?id=<?php echo $selected_items[$item]['id'];?>" role="button" class="btn btn-info">Edit</a></td>





</td>
</tr>
<?php } ?>






</table >

</div>
<script>
var exampleSocket = new WebSocket("ws://127.0.0.1:8080");
exampleSocket.onopen = function (event) {
   // exampleSocket.send("Here's some text that the server is urgently awaiting!"); 
  }

  exampleSocket.onmessage = function (event) {
    console.log(event.data);
    window.reload();
    //document.getElementById("ta").value += '\n'+event.data 
  }
</script>
<?php } ?>
</body>
</html>
