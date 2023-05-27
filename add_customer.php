<?php
global $connection;
require 'connection.php';
$m = '';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST['submit'])){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        if (empty($name) || empty($address) || empty($phone)){
            $m =  "Field Should Not Empty!";
        }else{
            $name = mysqli_real_escape_string($connection,$name);
            $address = mysqli_real_escape_string($connection,$address);
            $phone = mysqli_real_escape_string($connection,$phone);

           $sql = "INSERT INTO customers (c_name,c_address,c_phone) VALUES ('$name','$address','$phone')";
           $result = mysqli_query($connection,$sql);
           if ($result=='true'){
               $m = "Successfully Inserted!";
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
    <title>Add Customers</title>
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
        <form action="add_customer.php" method="post">
          <center>
              <h5><?php echo $m ;?></h5>
          </center>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">

                </div>
                <div class="mb-3">
                    <label for="Address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address">

                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">

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