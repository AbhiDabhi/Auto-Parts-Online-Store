<?php

session_start();
if(!isset($_SESSION["cart"])){
    $cart=serialize(array());
}else{
    $cart=unserialize($_SESSION["cart"]);
}


$id=$_POST['id'];
$num=$_POST['num'];
if($id!="-1") {
    $cart[$id] = (int)$num;
    $_SESSION['cart'] = serialize($cart);
}
try {
    $db = new PDO('mysql:host=localhost;dbname=test', "root", "root");
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    $db = null;
    die();
}
$keys=array_keys($cart);
$price=0;
foreach($keys as $key){
    $rows = $db->query("SELECT * from parts where  inventory > 0 and id=$key");
    if ($rows->rowCount() > 0) {
        $num = $cart[$key];
        $row=$rows->fetch();
        $price+=$row['price']*(int)$num;
    }
}
echo $price;
