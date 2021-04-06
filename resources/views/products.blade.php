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
	$sql = $conn->query("SELECT * FROM INVENTORY");
	$products = $sql->fetchAll();
?>

<?php 
    if(isset($_POST["add_to_cart"])) {
		echo ("Test if Button Pressed");
        if(isset($_COOKIE["shopping_cart"])) {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
        }
        else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');

        if(in_array($_POST["hidden_id"], $item_id_list)) {
            foreach($cart_data as $keys => $values) {
                if($cart_data[$keys]["item_id"] == $_POST["hidden_id"]) {
                    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
                }
            }
        }
        else {
            $item_array = array(
            'item_id'   => $_POST["hidden_id"],
            'item_name'   => $_POST["hidden_name"],
            'item_price'  => $_POST["hidden_price"],
            'item_quantity'  => $_POST["quantity"]
            );
            $cart_data[] = $item_array;
        }

        $item_data = json_encode($cart_data);
        setcookie('shopping_cart', $item_data, time() + (86400 * 30));
        header("location:index.php?success=1");
    }

    if(isset($_GET["action"])) {
        if($_GET["action"] == "delete") {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
            foreach($cart_data as $keys => $values) {
                if($cart_data[$keys]['item_id'] == $_GET["id"]) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    setcookie("shopping_cart", $item_data, time() + (86400 * 30));
                    header("location:index.php?remove=1");
                }
            }
        }

        if($_GET["action"] == "clear") {
            setcookie("shopping_cart", "", time() - 3600);
            header("location:index.php?clearall=1");
        }
    }

    if(isset($_GET["success"])) {
    $message = '
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Item Added into Cart
        </div>
        ';
    }
    if(isset($_GET["remove"])) {
        $message = '
        <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Item removed from Cart
        </div>
        ';
    }
    if(isset($_GET["clearall"])) {
        $message = '
        <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Your Shopping Cart has been clear...
        </div>
        ';
    }
?>

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">Products List</h2>
	</div>
	<br>

	<ul id="products" class="w3-ul w3-card-4" style="background-color:lightgray">
		@foreach ($products as $product)
		<li class="w3-bar w3-hover-blue-gray">
			<input type="submit" name="add_to_cart" class="btn btn-success w3-bar-item w3-button w3-right" value="Add to Cart +">
			<div id="product" class="w3-bar-item">
                <a href="/newproducts?sku=<?php echo $product['productSKU']; ?>"><span style="font-size:24px">{{ $product['name'] }}</span></a> <span>({{ $product['productSKU'] }})</span></br>
				<span>${{ number_format($product['price'], 2) }}</span></br>
				<span>{{ $product['itemdesc'] }}</span><br>
			</div>
		</li>
		@endforeach
	</ul>
</div>

@stop
