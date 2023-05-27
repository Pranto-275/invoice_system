<?php
global $connection;
require 'connection.php';
$m = '';
$invoice_total_price = 0;


$sql = "SELECT * FROM customers";
$results = mysqli_query($connection, $sql);


$sql = "SELECT * FROM items";
$result = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_assoc($result)) {

    $pricearray[$row['item_id']] = $row['price'];

}


function selectBox($connection)
{
    $data1 = '';
    $sql = "SELECT * FROM items";
    $result = mysqli_query($connection, $sql);


    while ($row = mysqli_fetch_assoc($result)) {

        $data1 .= '<option value="' . $row["item_id"] . '">' . $row["item_name"] . '</option>';
    }

    return $data1;

}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $c_id = $_POST['user_id'];
        $invoice_code = $_POST['invoice_code'];
        $items = $_POST['items'];
        $price = $_POST['price'];
        $qty = $_POST['qnt'];


        function totalprice($price, $qty)
        {
            for ($i = 0; $i < count($qty); $i++) {
                echo $price[$i] * $qty[$i];
            }
        }


        if (empty($c_id) || empty($invoice_code) || $items[0] == '' || $price[0] == '' || $qty[0] == '') {
            $m = "Field Should Not Empty";
        } else {

            for ($i = 0; $i < count($_POST['items']); $i++) {

                $row_total_price = $price[$i] * $qty[$i];

                $invoice_total_price = $invoice_total_price + $row_total_price;


                $sql = "INSERT INTO invoice (c_id, item_id, product_qty ,invoice_code,total) VALUES ('$c_id','$items[$i]','$qty[$i]','$invoice_code','$row_total_price')";
                $result = mysqli_query($connection, $sql);



                if ($result == 'true') {
                   $m = "Successfully Inserted!";
                }
            }

           $total_invoice_count = "INSERT INTO total_amount_table (c_id,invoice_code,Total_price) VALUES ('$c_id','$invoice_code','$invoice_total_price')";
           $total_invoice_count_result = mysqli_query($connection,$total_invoice_count);
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
    <link rel="stylesheet" href="css/all.min.css">
    <style>
        .box {
            width: 100%;
            height: auto;
            border: 1px solid black;
            padding: 50px;
            margin: 0 auto;

            border-radius: 10px;


        }

        .box button {
            font-size: 18px;
        }

        .top {
            margin: 100px;

        }

        .invoice_top {
            margin-top: 30px;
        }

        h5 {
            color: red;
        }
    </style>

</head>
<body>

<div class="container top">
    <div class="box">
        <h3 style="text-align: center; color: black;margin-bottom: 20px">WALTON PLAZA INVOICE</h3>
        <form action="invoice.php" method="post">
            <center>
                <h5><?php echo $m; ?></h5>
            </center>
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="mb-3">
                        <label for="Address" class="form-label">User Name</label>
                        <select class="form-select" aria-label="Default select example" style="color: black"
                                name="user_id">
                            <option value="">Select Customer</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($results)) { ?>
                                <option id="customer_id" value="<?php echo $row['c_id']; ?>"><?php echo $row['c_name']; ?></option>
                                <?php
                            }
                            ?>

                        </select>

                    </div>
                </div>
                <div class="col-lg-5 col-md-12">

                    <div class="mb-3">
                        <label for="Address" class="form-label">Invoice Number</label>
                        <input type="text" class="form-control" id="address" name="invoice_code">

                    </div>
                </div>
                <div class="col-lg-2 col-md-12">

                    <div class="mb-lg-3">

                        <div style="margin-top: 30px">

                            <a style="display: block" href="index.php" class="btn btn-danger">Back <i
                                    class="fa-sharp fa-solid fa-delete-left"></i></a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container invoice_top">

                <table class="table" id="inputs">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">Serial No</th>
                        <th scope="col">Item name</th>
                        <th scope="col">Price(tk)</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total(tk)</th>
                        <th scope="col"></th>

                    </tr>
                    </thead>
                    <tbody>

                    <div>
                    </div>


                    </tbody>
                </table>
                <div>
                    <button type="button" class="btn btn-success" id="adder"><i class="fa-solid fa-square-plus"></i>
                    </button>
                </div>


            </div>
            <div class="d-flex justify-content-between">
                <div>
                    Thank You For Your Business!
                </div>
                <div>
                    Total Amount: <b id="totalPRice">00</b>
                </div>
                <div style="margin-right: 15px">
                    <button type="submit" class="btn btn-info" name="submit">Save <i class="fa-solid fa-floppy-disk"></i></button>
                </div>
            </div>


        </form>

    </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script>
    // Input adding function

    var globIDcnt = 1;
    var totalPrice = 0;
    

    function addInput() {
        let prcid = "priceID" + globIDcnt;
        let itmid = "itemID" + globIDcnt;
        let itmqty = "itemQTY" + globIDcnt;
        let itemtotal = "itemTotal" + globIDcnt;
        let rowid = "rowId" + globIDcnt;
        globIDcnt++;
        var html = '';
        html += '<tr id="' + rowid + '">';
        html += '<td class="numberRow"><strong>1</strong></td>';
        html += '<td><select name="items[]" id="' + itmid + '" value="" onchange="priceFunction(this.id)"><option value="">Select Item</option><?php echo selectBox($connection);?></select></td>';
        html += '<td><input type="number"  id="' + prcid + '" name="price[]"></td>';
        html += '<td ><input type="number" id="' + itmqty + '"  name="qnt[]"></td>';
        html += '<td class="subtotal" id="' + itemtotal + '">0</td>';
        html += '<td><button class="btn btn-danger btn-sm remove"  id="' + rowid + '" ><i class="fa-solid fa-square-minus"></i></button></td>';
        html += '</tr>';
        $('#inputs').append(html);
        recalculate();

    }

    // Event handler and the first input
    $(document).ready(function () {
        $('#adder').click(addInput);
        addInput();

    });

    $(document).on('click', '.remove', function (event) {
        event.preventDefault();

        let globId = $(this).attr('id');
        let globNum = globId.replace(/\D/g, '');
        let temp = '#itemTotal' + globNum;

        let rmvedRowsTotalPrice = $(temp).html();

        let oldTotalPrice = $('#totalPRice').html();

        let updateTotalPrice = oldTotalPrice - rmvedRowsTotalPrice;



        $('#totalPRice').html(updateTotalPrice);

        $(this).closest('tr').remove();
        recalculate();


    })

    function recalculate() {
        var i = 1;
        $(".numberRow").each(function () {
            $(this).find("strong").text(i++);
        });
    }

    function priceFunction(e) {
        let item_price_arr = '<?php echo json_encode($pricearray) ?>'
        var item_price_arr_prse = JSON.parse(item_price_arr);
        let temp = '#' + e;
        var va = $(temp).val();
        var num = e.replace(/\D/g, '');
        var priceID = 'priceID' + num;
        var price_temp = '#' + priceID;
        $(price_temp).val(item_price_arr_prse[va]);

        var value = item_price_arr_prse[va];

        var qty = 'itemQTY' + num;
        var qty_id = '#' + qty;

        var total = 'itemTotal' + num;
        var total_id = '#' + total;


        $(qty_id).change(function () {
            var qty = $(qty_id).val();
            $(total_id).html(value * qty);

            totalPrice = totalPrice + Number(value * qty);

            $('#totalPRice').html(totalPrice);


        });


    }


    function total_price() {

        $('#totalPRice').html("pranto");

    }


</script>
</body>
</html>