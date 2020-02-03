<?php
include "User.php";

session_start();
if (isset($_SESSION["user"])) {
    $user=unserialize($_SESSION["user"]);
    if(($user->name)=="qiyuan@qiyuan"){
        header("Location: /auto-parts/admin.php");
        exit();
    }
}
$pageCount = 8;
try {
    $db = new PDO('mysql:host=localhost;dbname=test', "root", "root");
    $rows = $db->query('SELECT COUNT(*) from parts where inventory > 0');
    if ($rows->rowCount() > 0) {
        $row = $rows->fetch();
        $total = (int)$row[0];
        if ($total % $pageCount == 0) {
            $pageNum = $total / $pageCount;
        } else {
            $pageNum = $total / $pageCount + 1;
        }

    }
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    $db = null;
    die();
}
?>

<head>
    <meta charset="UTF-8">
    <title>Auto Parts</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/index.css" rel="stylesheet"/>
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
    var slides = $("#slide").find("div");
    /*
     function description(num){
     $(".description").text($(slides[num]).find("img").attr("alt"));
     }*/
    $(slides[0]).show();
    //description(0);
    for (var i = 1; i < slides.length; i++) {
        $(slides[i]).hide();
    }
    var now = 0;
    setInterval(function(){
        $(slides[now]).fadeOut();
        if(now==slides.length-1){
            now=0;
        }else{
            now+=1;
        }
        $(slides[now]).fadeIn();
    },4000)
    shows(1,5);
    $(".pagination").find("li").each(function() {
            $(this).click(function () {
                var a=$(this).find("a");
                var num=$(a).text();
                shows(num,5);
            });
        }
    );
    bag();


});

function bag(){
    $.post("bag.php",{},function(data){
        $("#bag").text(data);
    });
}

function cart(id){
    $.post("addCart.php",{"id":id},function(data){
        alert("success add in the cart");
    });
    bag();
}

function shows( num, pageCount){
    $.post("list.php",{"page":num,"pageCount":pageCount,"type":1},function(data){
        //alert(data);
        var content=$("#show");
        content.empty();
        //content.append(data);
        var arr = eval('(' + data +')');

        //var cont='<table>';
        for(var i=0;i<$(arr).length;i++){
            var cont='<div class="col-sm-3"><table>';
            cont = cont + '<tr><td><img class="img-rounded" src="items/'+arr[i]['id']+'.jpg"/></td></tr>';
            cont = cont + '<tr><td>' + arr[i]['name'] + '</td></tr>';
            cont = cont + '<tr><td>' + arr[i]['position'] + '</td></tr>';
            cont = cont + '<tr><td>' + arr[i]['type'] + '</td></tr>';
            cont = cont + '<tr><td>$' + arr[i]['price'] + '</td></tr>';
            cont = cont + '<tr><td><button type="button" class="btn btn-default btn-block" onclick="cart('+arr[i]['id']+')">Add To Cart</button></td></tr>';
            //cont = cont + '</table>';
            cont = cont + '</table></div>';
            content.append(cont);
        }
        //cont = cont + '</table>';
        //content.append(cont);
    });
}
	</script>
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

                <button type="submit" class="btn btn-default" ">Search</button>
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
        <div class="collapse navbar-collapse" id="myNavbar" >
            <ul class="nav navbar-nav" >
                <li><a href="index.php">Home</a></li>
                <li><a  href="position.php?position=Wheel">Wheel</a></li>
                <li><a  href="position.php?position=Light">Light</a></li>
                <li><a  href="position.php?position=Inner Parts">Inner Parts</a></li>
                <li><a  href="position.php?position=Machine Oil">Machine Oil</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" style ="margin-right: 0px;">
                <li><a href="myCart.php"><span class="glyphicon glyphicon-th-large"></span> My Cart &nbsp;<span id="bag" class="badge">7</span></a></li>

                <?php
                if (!isset($_SESSION["user"])) {
                    ?>
                    <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a data-toggle="modal" data-target="#myModal" id="login"><span
                                class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="account.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
										<li><a href="history.php" ><span class="glyphicon glyphicon-tag"></span> History</a></li>
                    <li><a href="login.php?type=2" ><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>

                    <?php
                }
                ?>

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

<!--content -->
<div class="container-fluid" style="margin-top: 1px;padding: 0;width: 1080px;">
        <div class="row" style="margin: 0px; padding: 0;height: 500px;" >
            <div class="col-xs-12" id="slide">
                <div><img src="img/7.jpg" ></div>
                <div><img src="img/8.jpg" ></div>
                <div><img src="img/9.jpg" ></div>
                <div><img src="img/10.jpg" ></div>
                <div><img src="img/11.jpg" ></div>
            </div>
        </div>
        <div class="col-sm-12" style="margin-top: 5px;margin-left: 3px;">
            <div class="panel panel-danger">
                <div class="panel-heading" style="color: black;"><strong>Search By Type</div>
                <div class="panel-body">
                    <form class="form" role="form" action="searchType.php" method="get">
                        <div class="form-group" style="padding: 0px;">
                            <div class="col-sm-1" style="margin-top: 6px;">
                                <label for="type" >Manufacturer: </label>
                            </div>
                            <div class="col-sm-2" style="margin-left: 20px;">
                                <select class="form-control" name="type">
                                    <option>Toyota</option>
                                    <option>Honda</option>
                                    <option>Ford</option>
                                    <option>AUDI</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-sm-1" style="margin-top: 6px;">
                                <label for="position">Part: </label>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control" name="position">
                                    <option>Wheel</option>
                                    <option>Light</option>
                                    <option>Inner Parts</option>
                                    <option>Machine Oil</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-sm-12" id="show">

        </div>
    </div>
    <div class="row">
        <div class=" col-sm-offset-5">
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= (int)$pageNum; $i++) {
                    ?>
                    <li><a><?= $i ?></a></li>
                    <?php
                }
                ?>
            </ul>

        </div>

    </div>


</div>

</body>
