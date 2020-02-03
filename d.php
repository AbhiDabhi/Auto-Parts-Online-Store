<?php

session_start();
if(!isset($_SESSION["cart"])){
    $cart=serialize(array());
}else{
    $cart=unserialize($_SESSION["cart"]);
}


$id=$_POST['id'];

unset($cart[$id]);
$_SESSION["cart"]=serialize($cart);
