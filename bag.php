<?php

session_start();
if(!isset($_SESSION["cart"])){
    echo 0;
}else{
    $cart=unserialize($_SESSION["cart"]);
    $keys=array_keys($cart);
    echo count($keys);
}