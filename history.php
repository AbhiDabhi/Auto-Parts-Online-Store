<?php
include "User.php";
session_start();

if (!isset($_SESSION["user"])) {

    echo "<script language='javascript'>";
    echo "alert(\"Please Login First\");";

    echo "location='index.php'";

    echo "</script>";

    exit();

}


$user = unserialize($_SESSION['user']);


?>

<head>
    <meta charset="UTF-8">
    <title>History</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
        <style>
		body{
		background-image:url('img/bg4.jpg');
		background-size:cover; 
		}
        a:visited {

        }

        a:hover {
            cursor: hand;
            text-decoration: none;
        }

        #show table {
            float: left;
            line-height: 30px;
            font-size: 20px;
        }

        #show img {
            height: 200px;
            width: 210px;
            margin-top: 15px;

        }
	

		#slide div {
	
			width: 1050px;
			height:500px;
			position: absolute;
			margin: 0;
		}
		#slide img {
			margin-left: 18px;
			width: 100%;
			height:100%;
			opacity: 0.8;
		}
    </style>
    <script>
        $(document).ready(function () {
           price1();

        });
        function price(id){
            //alert($("#"+id).val());
            if($("#"+id).val()<=0){
                $.post("d.php", {"id": id, "num": $("#" + id).val()}, function (data) {

                });
                location.reload();
            }else {
                $.post("price.php", {"id": id, "num": $("#" + id).val()}, function (data) {
                    $("#total").text("Total Price: $" + data);

                });
            }
        }
        function price1(){
            //alert(this.innerText);
            $.post("price.php",{"id":-1,"num":-1},function(data){
                $("#total").text("Total Price: $"+data);
					totalprice = data; 
            });
        }
		
		function check(id){
			 if($("#"+id).val()<=0){
                $.post("d.php", {"id": id, "num": $("#" + id).val()}, function (data) {

                });
                location.reload();
            }else {
				$.post("checkout1.php", {"id": id, "num": $("#" + id).val(), "totalprice": totalprice}, function (data){
					$("#total").text("1122 Price: $" + data);
				});
            }
        }
		
    </script>
</head>
<body>
<!-- header-->
<!-- header-->
<div class="container-fluid" style= "width: 1240px;text-align:center;">
    <div class="row" style="height:60px; margin-left: 50px;">
        <div class="col-xs-3" style="margin-top: 5px;">
            <a href="index.php"><img src="img/logo1.png" style="margin-top: 14px;"/></a>
        </div>
        <div class="col-xs-1">

        </div>
        <div class="col-xs-6" style="margin-left: 280px;">
            <form class="form-inline" role="form" style="margin-top: 14px;margin-left: 40px;" action="searchName.php" method="get">

                <input type="text" class="form-control" style="width: 60%" name="name" placeholder="Search By Item Name">

                <button type="submit" class="btn btn-default" style="color: black;">Search</button>
            </form>
        </div>
    </div>
</div>
<!-- navbar -->
<nav class="navbar navbar-inverse" style="margin: 0px;">
    <div class="container-fluid" style= "width: 1140px;text-align:center;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a  href="position.php?position=Wheel">Wheel</a></li>
                <li><a  href="position.php?position=Light">Light</a></li>
                <li><a  href="position.php?position=Inner Parts">Inner Parts</a></li>
                <li><a  href="position.php?position=Machine Oil">Machine Oil</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="account.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
                <li><a href="login.php?type=2"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>

            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid" style= "width: 1140px;text-align:center;">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10" style="margin-top: 10px;">
            <div class="panel panel-primary">
                <div class="panel-heading">My History</div>
					<div class="panel-body">
                  
                        <form class="form-horizontal" role="form" action="checkout.php" method="post" >
                            <?php
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
							$sql = "select * from orders where userid = $user->id;";
							$result = mysqli_query($con,$sql) or die('MySQL query error');
	
								while($row = mysqli_fetch_array($result))
								{
								$orderid=$row['orderid'];
								$sql1 = "select * from orderdetails where orderid = $orderid order by ordertime ;";
								$result1 = mysqli_query($con,$sql1) or die('MySQL query11 error');
								echo "<table class='myTable' id='myTable' rules='all'><tr><th>Order Id</th><th>Part Name</th><th>Number</th><th>Total Price</th><th>Order Time</th><th>Inventory</th></tr>";
								while($row1 = mysqli_fetch_array($result1)){
									if($row1['inventory']>0){$now = "In stock";}
									else{$now = "The item is not valid now";}
								echo "<tr><td>" . $row1['orderid'] . "</td><td>" . $row1['partname'] . "</td><td>" . $row1['number'] . "</td><td>" . $row1['totalprice'] . "</td><td>". $row1['ordertime'] . "</td><td>". $now . "</td></tr>" ;
								}
								echo "</table>"."<br>"."<br>";
								
								}
								}
                                
                                ?>
                                
                            <div class="form-group" style="margin: 0px;">
                                
                            </div>
                        </form>

                    <div class="col-sm-offset-8 col-sm-3">
                        <a href="index.php"><button class="btn btn-default btn-block">Keep Shopping</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





