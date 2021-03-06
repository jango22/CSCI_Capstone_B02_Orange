<?php session_start(); ?>
@extends('layout')

@section('title')
Update a Product
@stop

@section('content')
<!-- Make sure user is a logged in employee -->
<?php 
if(isset($_SESSION['username'])){
    if ($_SESSION['usertype'] !== 'admin') {
        die(header("Location: /login"));
    }
}
else {
    die(header("Location: /login"));
}

//Connect to database
$servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
$username = "orangeadmin";
$password = "capstone02";
$dbname = "OrangeDB";
$port = "1433";
$conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $username, $password);

//get each product category
$sql = $conn->query("SELECT DISTINCT category FROM INVENTORY");
$categories = $sql->fetchAll();
?>

<script>
    /* Enable forms script */
    $(document).ready(function() {
    $(".remove-attr").click(function(){            
        $("input").removeAttr("disabled");
    });
});
</script>

<?php $status = "disabled"; ?>

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">Update a Product</h2>
	</div>
	<br>



<!-- Search Product by SKU -->
<form method="POST" id="searchsubmit">
@csrf
    <div class="form-group row">
        <label for="searchSKUid:" class="col-sm-1 col-form-label">Search SKU:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="searchSKU" id="searchSKUid" placeholder="Search by SKU" maxlength="255" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="descid" class="col-sm-1 col-form-label"></label>
        <div class="offset-sm-3 col-sm-9 indent">
            <button type="submit" name="searchsubmit" id="searchsubmit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
<?php
    //Connect to database
    $servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
    $username = "orangeadmin";
    $password = "capstone02";
    $dbname = "OrangeDB";
    $port = "1433";
    $conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $username, $password); 

    //Get SKU value from POST
    if(isset($_POST['searchSKU'])){
        $searchSKU = $_POST['searchSKU'];
        $sql = $conn->query("SELECT * FROM INVENTORY WHERE productSKU = $searchSKU;");
        try {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC)[0];
            $price = number_format(floatval($data['price']),2);
        } catch (Exception $e) {
            echo "<script>alert('Error: SKU not found.');</script>";
        }
    //Enable forms on the rest of the page
    $status = "enabled";
    }
?>

<form method="POST" enctype="multipart/form-data">
@csrf
    <input type="hidden" name="productID" value="<?php echo $data['productID'] ?? ''; ?>"/>

    <label for="nameid" class="col-sm-1 col-form-label">Name:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="text" class="form-control" name="name" id="nameid" placeholder="Product Name" maxlength="255" style="width: 180px;" value="<?php echo $data['name'] ?? ''; ?>" required <?php echo $status; ?>><br><br>
    
    <label for="catid" class="col-sm-1 col-form-label">Category:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="text" class="form-control" name="category" list="catid" placeholder="Category" maxlength="255" style="width: 180px;" value="<?php echo $data['category'] ?? ''; ?>" required <?php echo $status; ?>/>
        <datalist id="catid">
            @foreach ($categories as $category)
                <option value="{{ $category['category'] }}">{{ $category['category'] }}</option>
            @endforeach
        </datalist>
    <br><br>
    
    <label for="SKUid" class="col-sm-1 col-form-label">SKU:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="number" class="form-control" name="SKU" id="SKUid" placeholder="Product SKU" min="0" max="9999999999" style="width: 180px;" value="<?php echo $data['productSKU'] ?? ''; ?>" required <?php echo $status; ?>><br><br>

    <label for="priceid" class="col-sm-1 col-form-label">Price:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="number" step="0.01" class="form-control" name="price" placeholder="Price" id="priceid" min="0" max="9999999999" style="width: 180px;" value="<?php echo $price ?? ''; ?>" required <?php echo $status; ?>><br><br>

    <label for="descid" class="col-sm-1 col-form-label">Description:&nbsp&nbsp
    <textarea name="desc" class="form-control" rows="6" id="descid" placeholder="Description" maxlength="255" style="vertical-align: top;" required <?php echo $status; ?>><?php echo $data['itemdesc'] ?? ''; ?></textarea><br><br></label>

    <label for="quantityid" class="col-sm-1 col-form-label">Quantity:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="number" class="form-control" name="quantity" placeholder="Quantity" id="quantityid" style="width: 180px;" value="<?php echo $data['quantity'] ?? ''; ?>" required <?php echo $status; ?>><br><br>

    <label for="imageid" class="col-sm-1 col-form-label">Image URL:</label>&nbsp
    <input type="text" class="form-control" name="image" placeholder="Image URL" id="imageid" style="width: 180px;" value="<?php echo $data['imageURL'] ?? ''; ?>" required <?php echo $status; ?>><br><br>

    <label for="greatdealid" class="col-sm-1 col-form-label">Set as Great Deal</label>&nbsp
    <input type="checkbox" class="form-control" name="greatdeal" id="greatdealid" value="yes" <?php echo $status; ?>
    
    <?php
        if (isset($data['greatDeal'])) {
            if ($data['greatDeal']=='yes') {
                echo ("checked");
            }
        }
    ?>
    ><br><br>
    
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <button type="submit" name="submit" class="btn btn-primary" <?php echo $status; ?>>Update Product</button>
</form>
<br><br>

<?php
    //Get values from POST
    if(isset($_POST['submit'])){
        $productID = $_POST['productID'];
        $name = $_POST['name'];
        $SKU = $_POST['SKU'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];
        $quant = $_POST['quantity'];
        $image = $_POST['image'];
        $category = $_POST['category'];
        $deal = "no";

        if(isset($_POST['greatdeal']) && $_POST['greatdeal']=="yes") {
            $deal = "yes";
        }

        $conn->query("UPDATE INVENTORY SET name='$name',productSKU='$SKU',price='$price',itemdesc='$desc', quantity='$quant', imageURL='$image', category='$category', greatDeal='$deal' WHERE productID='$productID';");
        echo "<script>alert('Updated successfully');</script>";
    }
?>
</div>
@stop
