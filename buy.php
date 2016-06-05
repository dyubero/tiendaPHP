
<html>

    <head>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css" />
        
        
         <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              
                <a class="navbar-brand" href="#"><h4>MR.ROBOT</h4></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                      <a href="logout.php?logout">Sign Out</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    </head>
    <body>
        
       
        <?php
        session_start();
        include_once 'dbconnect.php';




        $gpu = htmlspecialchars($_POST['GPU']);
        $nItems = htmlspecialchars($_POST['NumOfItems']);




        $conn = mysqli_connect("localhost", "root", "", "dbtest");

        $result = mysqli_query($conn, "SELECT * FROM products WHERE id_prod = $gpu");
        ?>
        
    <style>
body  {
    background-image: url('image/bgPagepng.png');
    background-repeat: no-repeat;
    background-size: 100%;
    background-attachment: fixed;
}
</style>

<?php
$row2 = mysqli_fetch_array($result);

if ($nItems > $row2['stock']) {
    $nItems = $row2['stock'];
    echo "<script>alert('You are going to order more products that we have in stock, your units will be the same as the stock');</script>";
}


isset($_SESSION['user']);

$res = mysql_query("SELECT * FROM users WHERE user_id=" . $_SESSION['user']);
$userRow = mysql_fetch_array($res);


$date = date("c");
$productName = $row2["product_name"];
$userMail = $userRow["email"];
$userID = $userRow["user_id"];
$totalPrice = $row2["price"] * $nItems;
$update_stock = $row2["stock"] - $nItems;
?>

<br><br><br><br>
        <div class="row">
             <div class="col-lg-2"></div>
             <div class="col-lg-8">
            <h2>Shopping cart</h2>
            <br>
            <table class="table table-bordered jumbotron">
                <thead>
                    <tr class="bg-warning">
                        <th><h3>User</h3></th>
                <th><h3>Image</h3></th>
                <th><h3>Product Name</h3></th>
                <th><h3>Product Price</h3></th>
                <th><h3>Unities</h3></th>
                <th><h3>Total Price</h3></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><h2><?php echo $userRow["email"]; ?></h2></td>
                        <td><img src="image/<?php echo $row2["image"]; ?>.jpg" alt=""></td>
                        <td><h2><?php echo $row2["product_name"]; ?></h2></td>
                        <td><h2><?php echo $row2["price"], "€"; ?></h2></td>
                        <td><h2><?php echo $nItems; ?></h2></td>
                        <td><h2><?php echo $row2["price"] * $nItems, "€"; ?></h2></td>
                    </tr>
                    <tr>

                </tbody>
            </table>
             </div>
             <div class="col-lg-2"></div>
        </div>



<div class="row">
    <div class="col-lg-2"></div>
        <div class="col-lg-8"> <button class="btn-lg btn-block btn-danger" onclick="myFunction()">BUY PRODUCTS</button></div>
         <div class="col-lg-2"></div>
</div>
        <script>
            
            function myFunction() {
<?php
if (mysql_query("INSERT INTO sales(saleuser,user_id,product_id,unities,totalprice,date) VALUES('$userMail','$userID','$gpu','$nItems','$totalPrice','$date')")) {
    echo "<script>alert('Your purchase has been realized');</script>";
}
mysql_query("update products set stock='$update_stock' WHERE id_prod='$gpu';");
?>
    }
        </script>











    </body>
</html>