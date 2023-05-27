<?php
global $connection;
require 'connection.php';
$m = '';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST['submit'])){
        $item_name = $_POST['item_name'];
        $item_des = $_POST['item_des'];
        $item_price = $_POST['item_price'];
        $item_qty = $_POST['item_qty'];
        if (empty($item_name) || empty($item_des) || empty($item_price) || empty($item_qty)){
            $m =  "Field Should Not Empty!";
        }else{
            $name = mysqli_real_escape_string($connection,$item_name);
            $address = mysqli_real_escape_string($connection,$item_des);
            $phone = mysqli_real_escape_string($connection,$item_price);
            $item_qty = mysqli_real_escape_string($connection,$item_qty);

            $sql = "INSERT INTO items (item_name,item_des,price,qty) VALUES ('$name','$address','$phone','$item_qty')";
            $result = mysqli_query($connection,$sql);
            if ($result=='true'){
                $m = "Successfully Item Inserted!";
            }else{
                $m = "Error!";
            }

        }
    }

}

?>





<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add items</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .box{
            width: 500px;
            height: auto;
            background: mediumpurple;
            padding: 50px;
            margin: 0 auto;

            border-radius: 10px;
            color: white;

        }
        .box button {
            font-size: 18px;
        }
        .top{
            margin: 100px;

        }

        h5 {
            color: black;
        }
    </style>

</head>
<body>

<div class="container top">
    <div class="box">
        <h3 style="text-align: center;">WALTON PLAZA INVOICE</h3>
        <form action="add_items.php" method="post">
            <center>
                <h5><?php echo $m ;?></h5>
            </center>
                <div class="mb-3">
                    <label for="name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="name" name="item_name">

                </div>
                <div class="mb-3">
                    <label for="des" class="form-label">Description</label>
                    <input type="text" class="form-control" id="des" name="item_des">

                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Item Price</label>
                    <input type="number" class="form-control" id="price" name="item_price">

                </div>
                <div class="mb-3">
                    <label for="qty" class="form-label">Item Quantity</label>
                    <input type="number" class="form-control" id="qty" name="item_qty">

                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <a href="index.php" type="submit" class="btn btn-danger">Back</a>
                </div>

        </form>
    </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>