<?php session_start(); ?>
@extends('layout')

@section('title')
Home
@stop

@section('content')

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
    <a class="w3-blue-gray" href="#">Product 1</a> <p> Price </p>
    <a class="w3-blue-gray" href="#">Product 2</a> <p> Price </p>
    <a class="w3-blue-gray" href="#">Product 3</a> <p> Price </p>
    <a class="w3-blue-gray" href="#">Product 4</a> <p> Price </p>
  </div>

  <div class="main">
    <h2>Welcome to Nuts and Bolts homepage!</h2>
    <p>In order to purchase and use our site as a customer we require you to create an account and login! All you need is a username and password to get rolling! Enjoy!</p>
  </div>

  <div class="right" style="text-align:center;">
    <h2>Notice</h2>
    <p>Nuts and Bolts is a small town, local company based in rural Ohio. All orders must be finalized by credit card. We offer shipping out of state VIA UPS at a flat rate of 14.99.</p>
  </div>
</div>
</main>

<footer class="w3-blue-gray" style="padding:5px;text-align:center;">     
  <p>Nuts and Bolts<br>
  <a href="mailto:nutsandboltsb02@gmail.com">nutsandboltsb02@gmail.com</a></p>
</footer>
        </div>
@stop
