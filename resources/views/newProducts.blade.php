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
<div class="container-sm" id="wrapper">

    <div class="w3-card-4 w3-blue-gray" >
    <h2 class="w3-center" >Products List</h2 >
    </div >
    <br >
    
   
    <div class="row" style="background:lightgray">
        <div class="card column" style="background:lightgray">
        
            <img src="https://i.imgur.com/uVymdir.png" alt="Product Image" style="width:100%" class="responsive">
            <h1>{{ $product['name'] }}</h1><span>({{ $product['productSKU'] }})</span></br>
            <p class="price">${{number_format($product['price'], 2) }}</p>
            <p>{{ $product['itemdesc'] }}</p>
            <p><button>Add to Cart</button></p>
            
        </div>
    </div>

   
</div>
@stop
