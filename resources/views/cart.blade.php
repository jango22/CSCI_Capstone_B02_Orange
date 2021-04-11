<?php 
    session_start();
    $servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
    $username = "orangeadmin";
    $password = "capstone02";
    $dbname = "OrangeDB";
    $port = "1433";
    $conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $username, $password);
?>
@extends('layout')

@section('title')
My Cart
@stop

@section('content')

<!-- Retrieve cart cookie -->
<?php
	$cart = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : '[]';
	$cartArray = json_decode($cart, true);
	$cart = json_decode($cart); // need to change this to an array
	$runningtotal=0;
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
		<input type="submit" name="clear-cart" value="Clear Cart">
		</form>
	</div>

	<!-- Output each item in the cart -->
	<ul id="products" class="w3-ul card cart" style="background-color:lightgray">
	@foreach ($cart as $cartitem)
		<li class="w3-bar">
			<div id="product" class="w3-bar-item">
				<span style="font-size:24px">{{ $cartitem->productName }}</span><br>
				Price: {{ $cartitem->price }}<br>
				Subtotal: ${{ $cartitem->price * $cartitem->quantity }}<br>
				<form method="POST">
				@csrf
					Qty:
            		<input type="number" class="form-control" name="quantity" id="quantity" maxlength="2" size="2" value="{{ $cartitem->quantity }}" min="0" style="width: 35px;">
					<input type="hidden" name="productName" value="{{ $cartitem->productName }}">
					<input type="submit" name="update-quantity" value="Update">
					<input type="submit" name="delete-item" value="Delete">   
				</form>
			</div>
		</li>
		@php
		$runningtotal = $runningtotal + $cartitem->price*$cartitem->quantity;
		@endphp
	@endforeach
	</ul>
	<h3 class="w3-center">Total: ${{ $runningtotal }}</h2> <br>
    <div class="w3-center">
    <form method="post">
    @csrf
        <input type="submit" name="checkout" value="Checkout">
    </form>
    </div>
</div>

<?php
if (!empty($_POST)) {
	/* Empty the cart if the clear cart button was pressed */
	if(isset($_POST['clear-cart'])) {
		setcookie('cart');
		echo "<script>alert('Your cart has been cleared.');</script>"; 
	}

	/* Update quantity of an item if the update quantity button was pressed */
	else if(isset($_POST['update-quantity'])) {
		for($i=0; $i<count($cart); $i++) {
			if($cart[$i]->productName == $_POST['productName'] and $cart[$i]->quantity != $_POST['quantity']) {
				$cart[$i]->quantity = $_POST['quantity'];
				setcookie("cart",json_encode($cart));
				echo "<script>alert('Item updated successfully.');</script>";
			}
		}
	}

	/* Delete an item if the delete button was pressed */
	else if(isset($_POST['delete-item'])) {
		for($i=0; $i<count($cart); $i++) {
			if($cart[$i]->productName == $_POST['productName']) {
				unset($cart[$i]);
				setcookie("cart",json_encode($cart));
				echo "<script>alert('Item deleted successfully.');</script>";
			}
		}
	}
    
    //Checkout funcitonality
    if (isset($_POST['checkout'])) {
    $outofstock = 0;
    $oosItems = array();
        for ($i=0; $i<count($cart); $i++) {
            $sku = $cart[$i]->sku;
            $sql2 = $conn->query("SELECT quantity FROM Inventory WHERE productSKU = '$sku'");
            $dbqnt = $sql2->fetchAll(PDO::FETCH_ASSOC)[0];
            $stock = $dbqnt['quantity'];
            if ($cart[$i]->quantity > $stock) {
                $outofstock++;
                $oosItems[] = $cart[$i]->productName;
            }
        }
        if ($outofstock > 0) {
            echo "<script type='text/javascript'> alert('The following items need their quantities reduced in order to checkout:".json_encode($oosItems)."') </script>";
            unset($oosItems);
        }
        else {
            echo "<script>alert('All items are safe to be checked out. Cart has been cleared and inventory reduced.');</script>";
            
             for ($i=0; $i<count($cart); $i++) {
                //quantity of item in cart
                $itemQuant = $cart[$i]->quantity;
                
                //item sku
                $sku = $cart[$i]->sku;
                
                //Query to grab quantity from db
                $sql2 = $conn->query("SELECT quantity FROM Inventory WHERE productSKU = '$sku'");
                $dbqnt = $sql2->fetchAll(PDO::FETCH_ASSOC)[0];
                
                //quantity of item in DB
                $oldStock = $dbqnt['quantity'];
                
                //new quantity to be stored in DB
                $newStock = $oldStock - $itemQuant;
                
                //sets the inventory quantity to new value
                $sql2 = $conn->query("UPDATE INVENTORY SET quantity='$newStock" WHERE productSKU = '$sku'");
             }
            
            unset($cart);
	        setcookie("cart",json_encode($cart))
        }
    }
	/* Refresh the page when done */
	header('Refresh: 0');
}
?>

@stop
