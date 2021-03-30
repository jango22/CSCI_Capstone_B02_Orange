<?php session_start(); ?>
@extends('layout')

@section('title')
My Cart
@stop

@section('content')
<?php
	//Connect to database
	$servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
	$username = "orangeadmin";
	$password = "capstone02";
	$dbname = "OrangeDB";
	$port = "1433";
	$conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $username, $password);

	//Get array of all products
	$sql1 = $conn->query("SELECT * FROM INVENTORY");
	$products = $sql1->fetchAll();

	//Get user's cart
	$userID = $_SESSION['userID'];
	$sql2 = $conn->query("SELECT cartID FROM CART WHERE userID = $userID");
	$cartID = $sql2->fetchAll(PDO::FETCH_ASSOC)[0];

	//Get array of all cart items
	$sql3 = $conn->query("SELECT productID FROM CARTITEMS");
	$cartitems = $sql3->fetchAll();
	echo print_r($cartitems);
?>

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">My Cart</h2>
	</div>
	<br>

	<ul id="products" class="w3-ul card" style="background-color:lightgray">
		@foreach ($products as $product)
		@if (in_array($product['productID'], $cartitems))
		<li class="w3-bar w3-hover-blue-gray">
			<span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">+</span>
			<div id="product" class="w3-bar-item">
				<span style="font-size:24px">{{ $product['name'] }}</span> <span>({{ $product['productSKU'] }})</span></br>
				<span>${{ number_format($product['price'], 2) }}</span></br>
				<span>{{ $product['itemdesc'] }}</span><br>
			</div>
		</li>
		@endif
		@endforeach
	</ul>
</div>

@stop
