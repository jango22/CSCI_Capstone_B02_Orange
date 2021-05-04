<?php session_start(); ?>
@extends('layout')

@section('title')
Home
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

<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div> 
  <div class="container-sm" id="wrapper">   
  
<div class="w3-blue-gray" style="padding:5px;text-align:center;">
  <h1>Nuts and Bolts Homepage</h1>
</div>

<main class="flex"  id="wrapper">
<div style="overflow:auto">
  <br>
  <div class="menu">
    <h2>Welcome to Nuts and Bolts homepage!</h2>
    <p>In order to purchase and use our site as a customer we require you to create an account and login! All you need is a username and password to get rolling! Enjoy!</p>
  </div>

  <!-- Great Deals Carousel -->
  <div class="main slideshow-container">
  @foreach ($products as $product)
    <div class="mySlides fade">
      <img src="{{ $product['imageURL'] }}" alt="Product Image" style="width:300px;">
      <div>{{ $product['name'] }} - ${{ number_format($product['price'], 2) }}</div>
    </div>
  @endforeach

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>

  <div class="right" style="text-align:center;">
    <h2>Notice</h2>
    <p>Nuts and Bolts is a small town, local company based in rural Ohio. All orders must be finalized by credit card. We offer shipping out of state VIA UPS at a flat rate of 14.99.</p>
  </div>
</div>
</main>
</div>
<footer class="w3-blue-gray" style="padding:5px;text-align:center;">     
  <p>Nuts and Bolts<br>
  <a href="mailto:nutsandboltsb02@gmail.com">nutsandboltsb02@gmail.com</a></p>
</footer>
        </div>


<!-- Script for Carousel -->
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
@stop
