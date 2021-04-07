<?php session_start(); ?>
@extends('layout')

@section('title')
My Cart
@stop

@section('content')

<!-- Retrieve cart cookie -->
<?php
	$cart = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : '[]';
	$cart = json_decode($cart);
	$runningtotal=0
?>

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">My Cart</h2>
	</div>
	
	<!-- Clear cart button -->
	<div class="w3-center">
		<form method="post">
		@csrf
		<input type="submit" name="clearCart" value="Clear Cart">
		</form>
	</div>

	<!-- Output each item in the cart -->
	<ul id="products" class="w3-ul card" style="background-color:lightgray">
	@foreach ($cart as $cartitem)
		<li class="w3-bar w3-hover-blue-gray">
			<div id="product" class="w3-bar-item">
				<span style="font-size:24px">{{ $cartitem->productName }}</span><br>
				Quantity: {{ $cartitem->quantity }}<br>
				Price: {{ $cartitem->price }}<br>
				Subtotal: ${{ $cartitem->price * $cartitem->quantity }}
				@php
				$runningtotal = $runningtotal + $cartitem->price*$cartitem->quantity;
				@endphp
			</div>
		</li>
		@endforeach
	</ul>
	<h3 class="w3-center">Total: ${{ $runningtotal }}</h2>
</div>

<!-- Empty the cart cookie if the clear cart button was pressed -->
<?php
	if(isset($_POST['clearCart'])) {
		setcookie('cart');
		header('Refresh: 0');
		echo "<script>alert('Your cart has been cleared');</script>"; 
	}
?>

@stop
