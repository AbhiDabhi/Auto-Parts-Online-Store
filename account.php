<?php
include "User.php";
/**
 * Created by Sublime Text
 * User: Qiyuan Hu
 * Date: 11/17/16
 * Time: 3:53 PM
 */
session_start();
$user = unserialize($_SESSION['user']);

?>

<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/account.js"></script>
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

</head>
<body>
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
                <li><a  href="position.php?position=Mechine Oil">Mechine Oil</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="myCart.php"><span class="glyphicon glyphicon-th-large"></span> My Cart &nbsp;<span id="bag"
                                                                                                                class="badge">9</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container-fluid" style= "width: 1300px;text-align:center;">
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8" style="margin-top: 10px;">
            <div class="panel panel-primary">

                <div class="panel-heading">Your Account</div>


                <div class="panel-body">
                    <div id="registerForm">
                        <span id="errorinfo"></span>
                        <!--action="php/login_chk.php" method="post"-->
                        <input type="hidden" value="<?=$user->id?>" id="id"/>
                        <input type="hidden" value="<?=$user->rank?>" id="rank"/>
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="text" class="form-control" value="<?=$user->email?>" id="email" disabled>
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="text" name="password" class="form-control" value="<?=$user->password?>" id="password_r">
                        </div>
                        <div class="form-group">
                            <label for="c_password">Confirm Password: </label>
                            <input type="text" name="c_password" class="form-control" value="<?=$user->password?>" id="c_password">
                        </div>
                        <div class="col-sm-offset-10 col-sm-2">
                            <input type="submit" name="submit" class="btn btn-default" value="Update"
                                   id="register_chk">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>