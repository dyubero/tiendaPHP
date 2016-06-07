

<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    
    
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    
    
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome-<?php echo $userRow['email']; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
    
    <style>
body  {
    background-image: url('image/bgPagepng.png');
    background-repeat: no-repeat;
    background-size: 100%;
    background-attachment: fixed;
}
</style>
    
<body>
    
    
    
    
     <?php 
     
     $conn = new mysqli("localhost","root","","dbtest");
     
     $sqlprod = "select * from products order by id_prod";
     $result = $conn->query($sqlprod);
     
   
  
   
     
     ?>
    
    
    
    
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              
                <a class="navbar-brand"><p id="nPag">MR.ROBOT</p></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                    <li >
                        <a href="logout.php?logout"  id="singOut">Sign Out</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-2">
             
            </div>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="image/nvidia.png" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="image/amd.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="image/intel.png" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="row">
<?php while ( $row = $result->fetch_assoc()) {
                           ?>
                <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="image/<?php echo $row["image"];?>.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right"><?php echo $row["price"];?>€</h4>
                                <h4> <?php echo $row["product_name"];?>
                                </h4>
                                
                            </div>
                                <p><h3>STOCK: <?php echo $row["stock"];?></h3></p>
                                
                                <form action="buy.php"  method="post">
                                
                                <input type="radio" name="GPU" value="<?php echo $row["id_prod"];?>">Select</input>
                                
                                
                        </div>
                    </div>
<?php } ?>
                   

                  
</br>
                </div>
                
                <div class="col-lg-3"></div>
                <div class="col-lg-7 jumbotron" id="divStock">
                    <b>Number of articles:</b>
               <input type="number" name="NumOfItems"></input>
               
               <button><b>BUY</b></button>
                </div>
                <div class="col-lg-2"></div>
                </form>
            </br>
            </br>
            </br>
            </div>

        </div>

    </div>
    <!-- /.container -->

    
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    
    
    
    
    
</body>
</html>

