<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add a Product</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
@if(session()->has('successmessage'))
    <div class="alert alert-success alert-dismissable fade show" role="alert">
        {{ session('successmessage') }}
    </div>
@endif

<h2>Add a Product to Inventory</h2>
<form method="POST">
@csrf
    <strong>Name:</strong></br>
    <input type="text" name="name"><br><br>

    <strong>SKU:</strong></br>
    <input type="number" name="SKU"><br><br>

    <strong>Price:</strong></br>
    <input type="number" name="price"><br><br>

    <strong>Description:</strong></br>
    <textarea name="desc" rows="12" cols="50"></textarea><br><br>

    <button name="submit">Submit</button>
</form>
<br>

<?php
    //Connect to database
    $servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
    $username = "orangeadmin";
    $password = "capstone02";
    $dbname = "OrangeDB";
    $port = "1433";
    $conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $username, $password); 

    //Get values from POST
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $SKU = $_POST['SKU'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];

        //Insert values into INVENTORY table
        $conn->query("INSERT INTO INVENTORY (name, productSKU, price, itemdesc) VALUES ('$name', $SKU, $price, '$desc');");

        //Send success message to user
        return redirect()->route('add')->with('successmessage','Added to inventory successfully.');
    }
?>

</body>
</html>