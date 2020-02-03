<?php
include "User.php";
session_start();

$password = $_POST["password"];
$email = $_POST["email"];
$id= $_POST['id'];
$rank = $_POST['rank'];

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "test";

$con = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

if (!$con)
{
    echo "Failed to connect to MySQL: ";
}


    $sql = "update user set password = '$password' where id = $id";

    $result = mysqli_query($con,$sql) or die('MySQL query error');
    $user = new User();
    $user->id = (int)$id;
    $user->email = $email;
    $user->password = $password;
    $user->rank =$rank;
    $_SESSION["user"] = serialize($user);
    echo 'success';

mysqli_close($con);