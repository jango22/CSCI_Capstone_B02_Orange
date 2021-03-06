<?php session_start(); ?>
@extends('layout')

@section('title')
Great Deals!
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
	
	//Get array of great deals
	$sql = $conn->query("SELECT * FROM INVENTORY WHERE greatDeal='yes'");
	$products = $sql->fetchAll();
?>

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">Our Great Deals</h2>
	</div>
	<br>

	<ul id="products" class="w3-ul w3-card-4" style="background-color:lightgray">
		@foreach ($products as $product)
		<li class="w3-bar w3-hover-blue-gray">
			<div id="product" class="w3-bar-item">
				<!-- Product image -->
				<div class="w3-bar-item w3-left">
					@if ($product['imageURL'])
					<a href="/product?sku=<?php echo $product['productSKU']; ?>"><img src="{{ $product['imageURL'] }}" alt="Product Image" style="width:80px;"></a>
					@else
					<a href="/product?sku=<?php echo $product['productSKU']; ?>"><img src="https://i.imgur.com/h1VYuuO.png" alt="Product Image" style="width:80px;"></a>
					@endif
				</div>
				<!-- Product information -->
				<div class="w3-bar-item w3-left">
					@if ($product['quantity'] > 0 && $product['greatDeal'] == "no")
						<a href="/product?sku=<?php echo $product['productSKU']; ?>"><span id="product-title">{{ $product['name'] }}</span></a><br>
					@elseif ($product['greatDeal'] == "yes")
						<a href="/product?sku=<?php echo $product['productSKU']; ?>"><span id="product-title">{{ $product['name'] }} - </span></a> <span id="Great-Deal">Great Deal!</span><br>
					@else
						<span id="product-title"><s>{{ $product['name'] }}</s></span>&nbsp;&nbsp;<span id="Out-of-stock">Out of Stock!</span><br>
					@endif
					<span>${{ number_format($product['price'], 2) }}</span><br>
				<span>{{ $product['itemdesc'] }}</span><br>
			</div>
			</div>
		</li>
		@endforeach
	</ul>
</div>
@stop
