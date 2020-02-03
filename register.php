<?php

?>

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/register.js"></script>
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
                <li><a  href="position.php?position=Machine Oil">Machine Oil</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="myCart.php"><span class="glyphicon glyphicon-th-large"></span> My Cart &nbsp;<span id="bag"
                                                                                                                class="badge">9</span></a>
                </li>
                <li><a data-toggle="modal" data-target="#myModal" id="login"><span
                            class="glyphicon glyphicon-log-in"></span> Login</a></li>


            </ul>
        </div>
    </div>
</nav>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login</h4>
            </div>
            <form class="form-horizontal" role="form" action="login.php?type=1" method="post">

                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Password:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="pwd" placeholder="Enter password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="container-fluid" style= "width: 1540px;text-align:center;">
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8" style="margin-top: 10px;">
            <div class="panel panel-primary">

                <div class="panel-heading">Register</div>


                <div class="panel-body">
                    <div id="registerForm">
                        <span id="errorinfo"></span>
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" name="password" class="form-control" id="password_r">
                        </div>
                        <div class="form-group">
                            <label for="c_password">Confirm Password: </label>
                            <input type="password" name="c_password" class="form-control" id="c_password">
                        </div>
                        <div class="col-sm-offset-10 col-sm-2">
                            <input type="submit" name="submit" class="btn btn-default" value="REGISTER"
                                   id="register_chk">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>