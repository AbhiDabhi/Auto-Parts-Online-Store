<?php

session_start();
if(!isset($_SESSION["cart"])){
    $_SESSION["cart"]=serialize(array());
}
$cart=unserialize($_SESSION["cart"]);
$id=$_POST['id'];
if(!isset($cart[$id])){
    $cart[$id]=1;
}
$_SESSION["cart"]=serialize($cart);
echo $id;