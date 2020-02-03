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
$pricein=$_POST['totalprice'];
$num=$_POST['num'];


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
				return;
					}
				}
	
			}
			   
		$ran = rand(1,10000);
		$sql = "insert into orders values ('$user->id',$ran);";
		$result = mysqli_query($con,$sql) or die('MySQL query error');
	    
	

	
			
	  

		foreach($keys as $key){
			$query = "SELECT * from parts where inventory > 0 and id=$key";
			$result = mysqli_query ($con,$query)or die('MySQL query error');
			
			

			
			$bol = -1;

			
			if($bol < 0 ){
			while($row = mysqli_fetch_array($result))
				{
			$num = (int)$cart[$key];
			$price = (float)$pricein;
			$name1=$row['name'];
			$inventory = $row['inventory'];
			$price1=$row['price']*(int)$num;

			$sql1 = "insert into orderdetails(orderid, partid, partname,number,totalprice,inventory) values ($ran,$key,'$name1','$num','$price1','$inventory');";
			$result = mysqli_query($con,$sql1) or die('MySQL query11 error');
			$sql2 = "update parts set inventory = inventory - '$num' where id = '$key';";
			$result = mysqli_query($con,$sql2) or die('MySQL query12 error');
			$sql2 = "update orderdetails set inventory = inventory - '$num' where partid = '$key';";
			$result = mysqli_query($con,$sql2) or die('MySQL query12 error');

				}
			   
			}

			
	  }
}

mysqli_close($con);
mysqli_close($con);
$_SESSION['cart']=serialize(array());
$_SESSION['totalprice']=serialize(array());

?>