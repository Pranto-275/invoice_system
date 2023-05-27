<?php
global $connection;
require 'connection.php';
$m = '';

$invoice_list_query = "SELECT DISTINCT customers.c_id,customers.c_name,invoice.invoice_code   FROM invoice INNER JOIN customers ON invoice.c_id = customers.c_id";






$invoice_list_result = mysqli_query($connection,$invoice_list_query);


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
            width: 800px;
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

<div class="container top ">
    <div class="box">
        <h3 style="text-align: center;">WALTON PLAZA INVOICE</h3>
        <table class="table text-center">
            <?php $i=0 ?>
            <thead class="table-light">
            <tr>
                <th scope="col">Serial</th>
                <th scope="col" >Username</th>
                <th scope="col">Invoice</th>

            </tr>
            </thead>
            <tbody class="text-light">

            <?php
            $i=0;
            while ($row = mysqli_fetch_assoc($invoice_list_result)){

                echo "
                    <tr>
                     <td> ".++$i."</td>
                      <td> ".$row['c_name']."</td>
                       <td>  
                        <span> 
                            <a href='show_invoice.php?id=".$row['c_id']."&invoice=".$row['invoice_code']."' class='btn btn-success'>Show Invoic</a>
                        </span>
                       </td>
                     
                     
                     </tr>
                
                
                ";
            }



            ?>



            </tbody>
        </table>
       <div class="float-end">
           <a href="index.php" class="btn btn-danger">Back</a>
       </div>
    </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>