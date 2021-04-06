<?php
 session_start();
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
<div class="w3-center w3-container" id="wrapper">

    <div class="w3-card-4 w3-blue-gray" >
    <h2 class="w3-center" >Products List</h2 >
    </div >
    <br>
        <div class="card" style="background:lightgray">
        
            <img src="https://i.imgur.com/uVymdir.png" alt="Product Image" style="width:100%">
            <h1>{{ $product['name'] }}</h1><span>({{ $product['productSKU'] }})</span></br>
            <p class="price">${{number_format($product['price'], 2) }}</p>
            <p>{{ $product['itemdesc'] }}</p>
            <form method="post">
                @csrf
                <input type="number" name="quantity" class="form-control" id="descid" placeholder="Quantity" min="1" required>
                <input type="submit" name="addCart" value="Add to Cart" />
            </form>
            
        </div>
   
</div>

@stop

<?php
    $price = number_format($product['price'], 2);
	if(isset($_POST['addCart'])) {
		//check if the item being added is in stock
        $quantity = $_POST['quantity'];
		$sql2 = $conn->query("SELECT quantity FROM Inventory WHERE productSKU = '$sku'");
        $dbqnt = $sql2->fetchAll(PDO::FETCH_ASSOC)[0];
        $qnt = $dbqnt['quantity'];
        $name = $product['name'];
        if($qnt > 0) {
            $cart = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : "[]";
            $cart = json_decode($cart);
            if(in_array($name,$cart)) {
                echo "<script>alert('Item is already in your cart');</script>";
            }
            else {
                $cart[] = array(
                "productName" => $name,
                "quantity" => $quantity,
                "price" => $price
            );
            print_r($cart);
            echo "<script>alert('Item added successfully');</script>";  
            }
            
            setcookie("cart",json_encode($cart));
              
        }
        else {
            echo "<script>alert('The item you want is out of stock! Please check back later.');</script>";
        }
	}
?>
