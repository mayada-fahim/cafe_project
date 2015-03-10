<html>
	<head>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="style.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	</head>
	<style>
	.right{
		margin-right:10px;
	}
	.top{
		margin-top:10px;
	}
	.border{
		border-bottom: 2px solid ;
	}
	</style>
	<body>
		<nav class="navbar navbar-default">
  			<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">BKAM CAFE</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a href="/project/php/userhome.php">Home</a></li>
       
        <li><a href="/project/php/userorders.php">My Orders</a></li>
       
      
        <li><div class="navbar-form">
    		<input type="text" class="form-control " placeholder="Search">
  			</div></li>
	</ul>
        
         
      <ul class="nav navbar-nav navbar-right">
        <li><img src="<?php session_start();if(isset($_SESSION['image'])) echo "../image/".$_SESSION['image'];?>"  height="30" width="30" class="navbar-img right top"></li>
        <li class="navbar-text"> <?php if(isset($_SESSION['username'])) echo $_SESSION['username']?> </li>
        <li> <a href="http://localhost/project/php/logout.php">logout</a> </li>

       
      </ul>
    </div>
  </div>
</nav>

		





	</body>
</html>
