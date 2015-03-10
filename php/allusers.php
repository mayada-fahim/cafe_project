<html>
<head>
	

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
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


$my = array('type'=>"user");	
 $all =ORM::getInstance();
 $all-> setTable("users");
 $array=$all->select($my);
//  $element_number=sizeof($array);



 // $ph=trim($array[0]['image']);	
	// $files = "/var/www/html/project/image/$ph";
	// unlink($files);



 $myroom=ORM::getInstance();
 $myroom->setTable("rooms");
//  $roomcond="id=".$array[0]['room_id'];
//  $myroomdata=$myroom->select($roomcond);



//  // print_r($myroomdata);//Array ( [0] => Array ( [id] => 1 [number] => 125 [phone] => 035551392 [place] => First Bulding ) ) 
//  $room_number=$myroomdata[0]['number'];
//  $room_ext=$myroomdata[0]['phone'];
// print_r($room_ext);
echo "<div class='container'>" ;

echo "<a href='/project/php/adduser.php'  class='btn btn-primary pull-right'  role='button' >Add User</a>";
 echo "<table  class='table table-bordered text-center'>";
			echo "<tr>";
			echo "<th><center>";
			echo "Name";
			echo "</th>";
			echo "<th><center>";
			echo "Room";
			echo "</th>";
			echo "<th><center>";
			echo "Image";
			echo "</th>";	
			echo "<th><center>";
			echo "Ext.";
			echo "</th>";
			echo "<th><center>";
			echo "Place";
			echo "</th>";
			echo "<th><center>";
			echo "Edit";
			echo "</th>";
			echo "<th><center>";
			echo "Delete";
			echo "</th>";


			echo "</tr>";


	$i=0; //to index the rows
//for ($i=0; $i <$element_number ; $i++) { 
	# code...
	foreach($array as$line)
	{//echo $array[$i]['username'];
		/*Array of room with spacefic id
Array ( [0] => Array ( [id] => 1 [number] => 125 [phone] => 035551392 [place] => First Bulding ) ) 
		*/

		//$roomcond="id=".$array[$i]['room_id'];
		$roomcond=array('id'=>$array[$i]['room_id']);
 		$myroomdata=$myroom->select($roomcond);
 		$room_number=$myroomdata[0]['number'];
 		$room_ext=$myroomdata[0]['phone'];
 		$room_place=$myroomdata[0]['place'];

	echo "<tr>";
			echo "<td>";
			echo $array[$i]['username'];
			echo "</td>";
			echo "<td>";
			echo $room_number;
			echo "</td>";
			echo "<td>";
			
			echo "<img src=".'../image/'.$array[$i]['image']." width='50px' height='50px'  class='img-rounded '>" ;


			

			 
			echo "</td>";
			echo "<td>";
			echo $room_ext;
			echo "</td>";
			echo "<td>";
			echo $room_place;
			echo "</td>";
			echo "<td>";
			echo "<a  role='button' class='btn btn-danger' href="."deleteuser.php?id=".$array[$i]['id'].">Delete</a> ";
 			echo "</td>";
			echo "<td>";
			echo "<a  role='button' class='btn btn-info' href="."edituser.php?id=".$array[$i]['id'].">Edit</a>";


			echo "</td>";


		echo "</tr>";
		 $i ++;
		
	}//End of Foreach



	
	// }//End of table
		
echo "</table>";
echo "</div>";

// 		//


}?>
</body>


</html>