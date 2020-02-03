<?php

include "User.php";

session_start();
$user = unserialize($_SESSION['user']);

if(!isset($_SESSION["cart"])){
    $cart=serialize(array());
}else{
    $cart=unserialize($_SESSION["cart"]);
}


$id=$_POST['id'];
$num=$_POST['numm'];
echo "hello";
					echo $num;

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "test";

$con = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

if (!$con)
{
    echo "Failed to connect to MySQL: ";
}
else{


			$keys=array_keys($cart);
			foreach($keys as $key){
				$query = "SELECT * from parts where id=$key";
				$result = mysqli_query ($con,$query)or die('MySQL query error');

				while($row = mysqli_fetch_array($result)){
				$inventory = $row['inventory'];
				$arr3 = $num;
				if($inventory < $arr3){
					
					echo "<script>alert('No enough inventory');</script>";
					mysqli_close($con);
					$_SESSION['cart']=serialize(array());
					$_SESSION['totalprice']=serialize(array());

					echo "<script language='javascript'>"; 
					echo " location='index.php ';"; 
					echo "</script>";

					}
				else{

					echo "<script>alert('Order Placed!');</script>";
					
					mysqli_close($con);
					$_SESSION['cart']=serialize(array());
					$_SESSION['totalprice']=serialize(array());


					}
				}
	
			}
			   
		
}




?>