<?php
 session_start();
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
<div class="w3-center w3-container" id="wrapper">

    <div class="w3-card-4 w3-blue-gray" >
    <h2 class="w3-center" >Products List</h2 >
    </div >
    <br >
    
   
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
	if(isset($_POST['addCart']) && isset($_SESSION['username'])) {
		//check if the item being added is in stock
        $quantity = $_POST['quantity'];
		$sql2 = $conn->query("SELECT quantity FROM Inventory WHERE productSKU = '$sku'");
        $dbqnt = $sql2->fetchAll(PDO::FETCH_ASSOC)[0];
        $qnt = $dbqnt['quantity'];
        if($qnt > 0) {        
		//check if a $_COOKIE[cart] exists
        $item_array = array (
                'item_name' => $product['name'],
                'item_quant' => $quantity,
                'item_total' => $quantity * $price
                );
            
            $cookie = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : "";
            $cookie = stripslashes($cookie);
            $saved_cart_items = json_decode($cookie, true);
            
            //checks if saved cart is null and correct the error if it is.
            if(!$saved_cart_items){
                $saved_cart_items=array();
            }
            if(array_key_exists($product['name'], $saved_cart_items)){
                // redirect to product list and tell the user it was added to cart
                header('Location: /products');
            }
            else {
            if(count($saved_cart_items)>0){
                foreach ($saved_cart_items as $row)
                    $item_array = array (
                    'item_name' => $row['item_name'],
                    'item_quant' => $row['item_quant'],
                    'item_total' => $row['item_total']
                );
            }
                // put item to cookie
                $json = json_encode($item_array, true);
                setcookie("cart", $json, time() + (86400 * 30), '/'); // 86400 = 1 day
                $_COOKIE['cart']=$json;
            }       
        }
        else {
            echo "<script>alert('The item you want is out of stock! Please check back later.');</script>";
        }
	}
	else {
        echo "<script>alert('You must be signed in to add an item to a cart.');</script>";
	}
?>
