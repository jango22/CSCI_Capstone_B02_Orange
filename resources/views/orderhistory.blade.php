﻿<?php session_start(); ?>
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
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
    }
	$sql = $conn->query("SELECT DISTINCT orderID FROM Orders WHERE username = '$username'");
	$userHist = $sql->fetchAll();
?>

<div class="container-sm" id="wrapper">
    <div class="jumbotron-fluid container">
        <img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
    </div>

    <div class="w3-card-4 w3-blue-gray">
        <h2 class="w3-center">Order History For User: {{$_SESSION['username']}} </h2>
    </div>
    <br>

    <ul id="products" class="w3-ul w3-card-4" style="background-color:lightgray">
        @foreach ($userHist as $transaction)
		<li class='w3-bar'>
            <div id="product" class="w3-bar-item">
                <a href="/order?orderID=<?php echo $transaction['orderID']; ?>"><span id="product-title">{{ $transaction['orderID'] }}</span></a></br>
                <?php
                    $orderID =  $transaction['orderID'];
                    $sql = $conn->query("SELECT DISTINCT dateCreated FROM Orders WHERE orderID =  '$orderID'");
	                $dates = $sql->fetchAll();
                    
                    $sql = $conn->query("SELECT DISTINCT cartTotal FROM Orders WHERE orderID =  '$orderID'");
	                $totals = $sql->fetchAll();

                    //Output date
                    $date = date("M d, Y g:i A", strtotime($dates[0]['dateCreated']));
                    echo "Date: $date<br>";
                ?>
                
                @foreach ($totals as $rows)
                Order Total: ${{ $rows['cartTotal']}}<br>
                @endforeach
            </div>
        </li>
		@endforeach
    </ul>
    
</div>
@stop
