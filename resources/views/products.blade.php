<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<div class="w3-top">
			<div class="w3-bar w3-green w3-card">
				<a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
				<a href="/" class="w3-bar-item w3-button w3-padding-large">HOME</a>
				<a href="/HProducts" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Products</a>
				<a href="/Contact" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Contact Us</a>
				<a href="/FAQ" class="w3-bar-item w3-button w3-padding-large w3-hide-small">FAQ</a>
				<a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>
			</div>
		</div>
		<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
			<a href="/HProducts" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Products</a>
			<a href="/Contact" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Contact Us</a>
			<a href="/FAQ" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">FAQ</a>
		</div>
		<br> <br>
		<title>Products</title>
        <div class="jumbotron-fluid container">
			<header>
				<img src="https://i.imgur.com/uVymdir.png" height="150" width="150" title="Logo" alt="Logo" class="center">
			</header>
		</div>
</head>

<body style="background-color:lightgray;">
<?php
	//Connect to database
	$servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
	$username = "orangeadmin";
	$password = "capstone02";
	$dbname = "OrangeDB";
	$port = "1433";
	$conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $username, $password);

	//Get array of products
	$sql = $conn->query("SELECT * FROM INVENTORY");
	$products = $sql->fetchAll();
?>
<main class="flex"  id="wrapper" style="background-color:lightgray">
	<div class="w3-container">
	<div class="w3-card-4 w3-orange">
		<h2 class="w3-center">Products List</h2>
	</div>
	<input type="text" id="myInput" onkeyup="tableSearch()" placeholder="Search for products .." title="Type in a name">
	<ul id="myUL" class="w3-ul w3-card-4" style="background-color:lightgray">
		@foreach ($products as $product)
		<li class="w3-bar w3-hover-green">
			<span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">×</span>
			<div class="w3-bar-item w3-left">
				<span style="font-size:24px">{{ $product['name'] }}</span> <span>({{ $product['productSKU'] }})</span></br>
				<span>${{ number_format($product['price'], 2) }}</span></br>
				<span>{{ $product['itemdesc'] }}</span><br>
			</div>
		</li>
		@endforeach
	</ul>
	</div>
</body>

<footer>
</footer>
<script>
    function tableSearch() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
		li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("h3")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
	function myFunction() {
		var x = document.getElementById("navDemo");
		if (x.className.indexOf("w3-show") == -1) {
			x.className += " w3-show";
		}
		else {
			x.className = x.className.replace(" w3-show", "");
		}
	}
</script>
</html>
