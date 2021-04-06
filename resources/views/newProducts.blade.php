<?php
//Connect to database
$servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
$username = "orangeadmin";
$password = "capstone02";
$dbname = "OrangeDB";
$port = "1433";
$conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $username, $password);
//Get array of products
$sku = $_GET['sku'];
$sql = $conn-> query("SELECT * FROM INVENTORY WHERE productSku = $sku");
$product = $sql->fetchAll(PDO::FETCH_ASSOC)[0];
?>
@extends('layout')

@section('title')
Add a Product
@stop

@section('content')
<div class="w3-center w3-container" id="wrapper">

    <div class="w3-card-4 w3-blue-gray" >
    <h2 class="w3-center" >Products List</h2 >
    </div >
    <br >
    
   
        <div class="w3-card"" style="background:lightgray">
        
            
            <h1>{{ $product['name'] }}</h1><span>({{ $product['productSKU'] }})</span></br>
            <p class="price">${{number_format($product['price'], 2) }}</p>
            <p>{{ $product['itemdesc'] }}</p>
            <p><button name="addCart">Add to Cart</button></p>
            
        </div>
   
</div>

@stop

<?php
	//checks if the button addCart has been pressed and if the user is logged in.
	//if user isnt logged in, the session variable username gets set to guest
	if(isset($_POST['addCart']) && isset($_SESSION['username'])) {
		//check if the item being added is in stock
		$conn->query('SELECT quantity FROM Inventory WHERE');
		//check if a $_SESSION[cart] exists
		//create one if not
		//add the item or quantity to the cart, quantity increases if item exists
	}
	else {

	}
?>
