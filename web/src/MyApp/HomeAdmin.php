<?php 
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

 

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }



    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
 
            foreach ($this->clients as $client) {
            $client->send($msg);
            
            }
        }

      
    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}


?>



<!DOCTYPE html>
<html>
<head>
	<title>home admin</title>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


<script>


// setInterval(function(){
//  /* write your code here 
//  go to database and featch all orders again

// */ 
// console.log("hello");

//    if (window.XMLHttpRequest) {
//             // code for IE7+, Firefox, Chrome, Opera, Safari
//             xmlhttp = new XMLHttpRequest();
//         } else {
//             // code for IE6, IE5
//             xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//         }
//         xmlhttp.onreadystatechange = function() {
//             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//                 arr = JSON.parse(xmlhttp.responseText);
//                 for(){
                  
//                 }
                
//             }
//         }
       
//         	xmlhttp.open("GET","homeajax.php?",true);
// 	        xmlhttp.send();

// }, 1000);

	function getStatus(option,orderId) {
    var value = option.value;
    console.log("orderId="+orderId);
    console.log("value="+value);
    
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            	 //document.getElementById(orderId).removeChild();
                 document.getElementById("ty").innerHTML = xmlhttp.responseText;
                 window.location.reload();
            }
        }
       
        	xmlhttp.open("GET","HomeAdmin.php?id="+orderId+"&opt="+value,true);
	        xmlhttp.send();
}



</script>



</head>
<body >
<?php 
  
include_once("AdminCss.php");///








if (isset($_SESSION['username']) && isset($_SESSION['image'])) {
      
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }


 if (isset($_GET['id']) && isset($_GET['opt'])) {

	$orderId = $_GET['id'];
	$option = $_GET['opt'];

	$obj = ORM::getInstance();
	$table1 = $obj->setTable('orders');

	$data = array('status'=> $option);
	$obj->update($data,$orderId);

	
  }
 
 else{

	$obj = ORM::getInstance();
	$table1 = $obj->setTable('orders');
	$table2 = $obj->setTable1("users");
	$orders = $obj->join($table1,$table2 ,"userId","id");
	
?>


<div class="container">
  <h2>Order List</h2>
            
  <table class="table table-striped" id="1">
    <thead>
      <tr>
        <th class="text-center" >Order Date</th>
        <th class="text-center" >Name</th>
        <th class="text-center" >Room</th>
        <th class="text-center" >Total Order(LE)</th>
        <th class="text-center" >Action</th>

      </tr>
    </thead>

    <tbody>
    <?php
    $temp = array();

     foreach ($orders as $key => $value) {
    	
    		if ($value['status'] != "done") {
    	
    ?>
      <tr id="<?php echo $value['id']?>">
        <td class="text-center" ><?php echo $value['date'];?></td>
        <td class="text-center" ><?php echo $value['room'];?></td>
        <td class="text-center"> <?php echo $value['username']?> </td>
	    	<td class="text-center"> <?php echo $value['total']?> </td>
        <td>
		    <select class="form-control input-m" onchange="getStatus(this,<?php echo $value['id']?>)">
		       
		       <option value="processing">processing</option>
			   <option value="on the way">on the way </option>
		       <option value="done">deliverd</option>
		    </select>
        </td>
        
      </tr>
      <td>
     <!--  <div class="alert alert-success" role="alert" > -->
     <?php 
     	 	
			$obj->setTable("order_item");
			$itemIds = $obj->selectwhere("orderId",$value['id']);
			for ($i=0; $i <count($itemIds) ; $i++) { 
				?>

			
	 		<?php
	 		$obj->setTable("products");
	 		$OrderInfo = $obj->selectwhere("id",$itemIds[$i]['itemId']);
	 		foreach ($OrderInfo as $key => $value) {
	 			
	 			?>
	 		<div  class="alert alert-success list-group-item media-left" style="float:left" role="alert">
	 		
	 		<span class="badge text-center"><?php echo $itemIds[$i]['amount']."  "; ?></span> 
	 		
	 		<img src="../uploads/<?php echo $value['image']?> " class="img-circle" style="width:70px;height:70px;" >
			
<?php
				echo "<br/>";
				echo $value['name']."<br/>";
	 			echo $value['price']." LE"."<br/>";
	 			
		}

     ?>
   <!--   </div> -->
      </div>
  <?php 

	
  }}

}


  }//else closing


  }else{ // closing session condition

    header("Location: http://localhost/PHP-Project/docs/Login.php");

    }  ?>    
      </td>
    </tbody>
  </table>

  <div id="ty"></div>
</div>

</body>
</html>