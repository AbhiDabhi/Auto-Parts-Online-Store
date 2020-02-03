<?php
include "User.php";

session_start();
$user = unserialize($_SESSION['user']);
echo "$user->id";