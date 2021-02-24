<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add a Product</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

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
        echo var_dump($_POST);
        echo($_POST['name']);
        $name = $_POST['name'];
        $SKU = $_POST['SKU'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];

        //Insert values into INVENTORY table
        $conn->query("INSERT INTO INVENTORY (name, productSKU, price, itemdesc) VALUES ('$name', $SKU, $price, '$desc');");
    }
?>

</body>
</html>