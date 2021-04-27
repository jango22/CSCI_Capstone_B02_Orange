<?php session_start(); ?>
@extends('layout')

@section('title')
Add a Product
@stop

@section('content')
<!-- Make sure user is a logged in employee -->
<?php 
if(isset($_SESSION['username'])){
    if ($_SESSION['usertype'] !== 'admin') {
        die(header("Location: /login"));
    }
}
else {
    die(header("Location: /login"));
}
?>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }
</script>

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">Add a Product to Inventory</h2>
	</div>
	<br>


<form method="POST" enctype="multipart/form-data">
@csrf
    <label for="nameid" class="col-sm-1 col-form-label">Name:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="text" class="form-control" name="name" id="nameid" placeholder="Product Name" maxlength="255" style="width: 180px;" required><br><br>
    
    <label for="catid" class="col-sm-1 col-form-label">Category:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="text" class="form-control" name="category" id="catid" placeholder="Category" maxlength="255" style="width: 180px;" required><br><br>
    
    <label for="SKUid" class="col-sm-1 col-form-label addinput">SKU:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="number" class="form-control" name="SKU" id="SKUid" placeholder="Product SKU" min="0" max="9999999999" size="20" style="width: 180px;" required><br><br>

    <label for="priceid" class="col-sm-1 col-form-label addinput">Price:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="number" step="0.01" class="form-control" name="price" placeholder="Price" id="priceid" min="0" max="9999999999" style="width: 180px;" required><br><br>

    <label for="descid" class="col-sm-1 col-form-label">Description:&nbsp&nbsp
    <textarea name="desc" class="form-control" rows="6" id="descid" placeholder="Description" maxlength="255" style="vertical-align: top;" style="width: 150px;" required></textarea><br><br></label>

    <label for="descid" class="col-sm-1 col-form-label">Quantity:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="number" name="quantity" class="form-control" rows="6" id="descid" placeholder="Quantity" style="width: 180px;" required><br><br>

    <label for="imageid" class="col-sm-1 col-form-label">Image URL:</label>&nbsp
    <input type="text" class="form-control" name="image" placeholder="Image URL" id="imageid" style="width: 180px;" required><br><br>
    
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
</form>

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
        $quant = $_POST['quantity'];
        $image = $_POST['image'];
        $category = $_POST['category'];

        //Check for duplicate name
        $sql = $conn->query("SELECT Name FROM INVENTORY;");
        $names = $sql->fetchAll(PDO::FETCH_COLUMN);
        $sql = $conn->query("SELECT ProductSKU FROM INVENTORY;");
        $SKUs = $sql->fetchAll(PDO::FETCH_COLUMN);
        if (in_array($name, $names)) {
            $msg = "The name '$name' is already taken. Please choose a different one.";
            echo "<div class='alert alert-danger alert-dismissable fade in' role='alert'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    $msg
                </div>";
        }
        //Check for duplicate SKU
        elseif (in_array($SKU, $SKUs)) {
            $msg = "The product SKU '$SKU' is already taken. Please choose a different one.";
            echo "<div class='alert alert-danger alert-dismissable fade in' role='alert'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    $msg
                </div>";
        } 
        //Insert values into INVENTORY table
        else {
            $conn->query("INSERT INTO INVENTORY (name, productSKU, price, itemdesc, quantity, imageURL, category) VALUES ('$name', $SKU, $price, '$desc', $quant, '$image', $category);");
            $msg = "Added to inventory successfully.";
            echo "<div class='alert alert-success alert-dismissable fade in' role='alert'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    $msg
                </div>";
        }
    }
?>
@stop
