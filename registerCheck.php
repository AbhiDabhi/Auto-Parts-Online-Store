<?php
include "User.php";
session_start();

$password = $_POST["password"];
$email = $_POST["email"];

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "test";

$con = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

if (!$con)
{
    echo "Failed to connect to MySQL: ";
}

$query1 = "select * from user where email = '$email';";
$match1_e = mysqli_query($con,$query1) or die('MySQL query error');
$match2_e = mysqli_fetch_array($match1_e);


if ($match2_e)
{
    echo 'error1';
}

else
{
    $sql = "insert into user values (null,'$email', '$password',1);";

    $result = mysqli_query($con,$sql) or die('MySQL query error');


    $result1 = mysqli_query($con, "SELECT * FROM user where email ='$email'");

    if($row = mysqli_fetch_array($result1))
    {
        $id =$row['id'];
    }

    $user = new User();
    $user->id = (int)$id;
    $user->email = $email;
    $user->password = $password;
    $user->rank =1;
    $_SESSION["user"] = serialize($user);
    echo 'success';
}
mysqli_close($con);