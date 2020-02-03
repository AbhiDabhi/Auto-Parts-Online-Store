<?php
include "User.php";
session_start();
if (isset($_GET["type"])) {
    if ($_GET["type"] == "1") {
        $email = $_POST["email"];
        $password = $_POST["pwd"];

        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "root";
        $dbname = "test";

        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if (!$con) {
            echo "Failed to connect to MySQL: ";
        }


        $sql = "SELECT * from user where email = '$email' and password='$password'";

        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        if (!($row)) {
			echo "<script>alert('Wrong User Name or Password');
			location.href='login.php';
			</script>";
            
            exit;
        } else {

            $user = new User();
            $user->email = $row['email'];
            $user->id = $row['id'];
            $user->rank = (int)$row['rank'];
            $user->password = $row['password'];
            $_SESSION["user"] = serialize($user);

        }
    } else if ($_GET["type"] == "2") {
        session_destroy();
    }
}
if ($_GET["type"] == "1" && $user->rank == "2") {
    header("Location: /auto-parts/admin.php");
} else {
    header("Location: /auto-parts/index.php");
}
exit;