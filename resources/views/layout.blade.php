<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html style="background-color: rgba(195,195,195);" lang="en">
<head>
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<div class="w3-top">
			<div class="w3-bar w3-blue-gray w3-card">
				<a href="/" class="w3-bar-item w3-button w3-padding-large">Home</a>
				<a href="/products" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Products</a>
				<a href="/contact" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Contact Us</a>
				<a href="/faq" class="w3-bar-item w3-button w3-padding-large w3-hide-small">FAQ</a>
				<a href="/add" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Add Product</a>
				<a href="/update" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Update Product</a>
				<a href="" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-right">Log Out</a>
        		<span href="" class="w3-bar-item w3-padding-large w3-hide-small w3-right">Welcome, 
                
                <?php if (isset($_SESSION['username']) { echo $_SESSION['username']; } ?></span>
			</div>
		</div>
</head>	  
<body>
@yield('content')
</body>
</html>

