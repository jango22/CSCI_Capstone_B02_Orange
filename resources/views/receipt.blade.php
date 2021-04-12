<?php session_start(); ?>
@extends('layout')

@section('title')
Products
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
	//Get array of products
	$orderID = $_SESSION['orderID'];
	$sql = $conn->query("SELECT * FROM Orders WHERE orderID = '$orderID'");
	$order = $sql->fetchAll();
?>

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">Order ID : {{$orderID}}</h2>
	</div>
	<br>

	<ul id="products" class="w3-ul w3-card-4" style="background-color:lightgray">
		@foreach ($order as $transaction)
		<li class="w3-bar">
			<div id="product" class="w3-bar-item">
				<span style="font-size:24px">{{ $transaction['productName'] }}</span><br>
				Quantity: {{ $transaction['itemQuant'] }}<br>
				Subtotal: {{ $transaction['total']}}<br>
			</div>
		</li>
		@php
		$runningtotal = $runningtotal + $cartitem->price*$cartitem->quantity;
		@endphp
	@endforeach
	</ul>
</div>

@stop
