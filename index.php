<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Project</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .box{
            width: 600px;
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
    </style>

</head>
<body>
<center>

    <div class="container top">
        <div class="box">
            <h3 style="   text-align: center;">WALTON PLAZA INVOICE</h3>
            <a href="add_customer.php" class="btn btn-success">Add Customer</a>
            <a href="add_items.php" class="btn btn-info">Add Items</a>
            <a href="invoice.php" class="btn btn-warning">Create</a>
            <a href="invoice_list.php" class="btn btn-dark">Invoice List</a>
        </div>
    </div>

</center>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>