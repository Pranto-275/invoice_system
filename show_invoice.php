<?php
global $connection;
require 'connection.php';
$m = '';
$id = $_GET['id'];
$invoice = $_GET['invoice'];


$query = "SELECT * FROM invoice WHERE c_id='$id' AND invoice_code = '$invoice'";

$result1 = mysqli_query($connection,$query);
$result2 = mysqli_query($connection,$query);



$customer_query = "SELECT * FROM customers WHERE c_id='$id'";
$customer_query_result = mysqli_query($connection,$customer_query);


//data


$invoice_all_query = "SELECT *  FROM invoice JOIN customers ON invoice.c_id = customers.c_id JOIN items ON invoice.item_id = items.item_id where invoice.c_id = '$id' AND invoice.invoice_code = '$invoice'";

$invoice_all_result = mysqli_query($connection,$invoice_all_query);




//TOTAL PRICE query

$total_price_query = "SELECT * FROM total_amount_table WHERE invoice_code='$invoice'";
$get_total_price = mysqli_query($connection,$total_price_query);



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Invoice</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
            .box_border{
                border: 1px solid black;
                padding: 30px;
                border-radius: 10px;
            }

            @media only screen and (max-width: 777px) {
                .text_design {
                    margin-right: -300px;
                }
            }



    </style>
</head>
<body style="margin-top: 100px">
<div class="container py-4 box_border">
   <div class="row" >
       <div class="col-12 col-md-8">
           <h1 class="display-4">Walton IT</h1>
       </div>
       <div class="col-12 col-md-4">
           <h3 >INVOICE</h3>
           <?php
            $date = mysqli_fetch_assoc($result1);
            echo  " 
                Billing Date: ".$date['creation_time']." ";


           ?>
       </div>
   </div>
    <div class="row">
        <hr>
        <div class="col-4 ">
            Name <br>
            Address     <br>
            Phone       <br>
            Membership date <br>
        </div>
        <div class="col-2">
            : <br>
            : <br>
            : <br>
            : <br>
        </div>
        <div class="col-6">

            <?php
            $customer_data = mysqli_fetch_assoc($customer_query_result);
            echo  " 
               <b> ".$customer_data['c_name']."</b> <br> 
               <b> ".$customer_data['c_address']."</b> <br> 
               <b> ".$customer_data['c_phone']."</b> <br>
               <b> ".$customer_data['added_time']."</b> <br>";


            ?>


        </div>
    </div>

    <div class="div  my-5">

        <?php
        $invoice = mysqli_fetch_assoc($result2);

        echo  " 
              <b > Invoice Code:  <span style='color: red'>".$invoice['invoice_code']."</span> </b> ";
        ?>

        <table class="table">
            <thead  class="table-light">
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Items</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price(TK)</th>
                <th scope="col">Amount</th>
            </tr>
            </thead>
            <tbody >

            <?php
            $i=0;
            while ($row = mysqli_fetch_assoc($invoice_all_result)){
               echo "<tr> 
                        <td>".++$i."</td>
                         <td>".$row['item_name']."</td>
                          <td>".$row['product_qty']."</td>
                           <td>".$row['price']."</td>
                             <td>".$row['total']."</td>
                    </tr>";
            }

            ?>




            </tbody>

        </table>
        <div class="float-start">Thank You For Your Business</div><br>
        <div style="padding: 10px;">
            <a href="invoice_list.php" class="btn btn-danger">Invoice List</a>
        </div>
        <div class="float-end " style="margin-right: 200px;margin-top: -80px">
            <?php
            $row = mysqli_fetch_assoc($get_total_price);

            echo "   <h5><b class='text_design'>Total:".$row['Total_price']."</b></h5>";

            ;?>

        </div>

    </div>

</div>



<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>