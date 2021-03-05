<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Update a Product</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        /* Dismissable alert script */
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
        
    </script>
    <style>
        h2 {text-indent: 10px;}
        .btn.btn-primary:disabled{background-color: #858585;}
    </style>
</head>

<body>
<h2>Update a Product</h2>

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
        $data = $sql->fetchAll(PDO::FETCH_ASSOC)[0];
    }
?>
<script>
/* Remove readonly element script */
$(document).on(function(){
            $("#searchsubmit").click(function(event){
                event.preventDefault();
                $("input").prop("disabled",false);
                $("textarea").prop("disabled",false);
                $("button").prop("disabled",false);
            });
        });
</script>

<form method="POST" enctype="multipart/form-data">
@csrf
    <div class="form-group row">
        <label for="nameid" class="col-sm-1 col-form-label">Name:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="name" id="nameid" placeholder="Product Name" maxlength="255" value="<?php echo $data['name'] ?? ''; ?>" required disabled>
        </div>
    </div>

    <div class="form-group row">
        <label for="SKUid" class="col-sm-1 col-form-label">SKU:</label>
        <div class="col-sm-3">
            <input type="number" class="form-control" name="SKU" id="SKUid" placeholder="Product SKU" min="0" max="9999999999" value="<?php echo $data['productSKU'] ?? ''; ?>" required disabled>
        </div>
    </div>

    <div class="form-group row">
        <label for="priceid" class="col-sm-1 col-form-label">Price:</label>
        <div class="col-sm-3">
            <input type="number" step="0.01" class="form-control" name="price" placeholder="Price" id="priceid" min="0" max="9999999999" value="<?php echo $data['price'] ?? ''; ?>" required disabled>
        </div>
    </div>

    <div class="form-group row">
        <label for="descid" class="col-sm-1 col-form-label">Desc:</label>
        <div class="col-sm-3">
            <textarea name="desc" class="form-control" rows="6" id="descid" placeholder="Description" maxlength="255" required disabled><?php echo $data['itemdesc'] ?? ''; ?></textarea>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="descid" class="col-sm-1 col-form-label"></label>
        <div class="offset-sm-3 col-sm-9 indent">
            <button type="button" name="submitupdate" class="btn btn-primary" disabled>Update Product</button>
        </div>
    </div>
</form>
<br>



<?php
    //Connect to database
    $servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
    $username = "orangeadmin";
    $password = "capstone02";
    $dbname = "OrangeDB";
    $port = "1433";
    $conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $username, $password); 

    //Get values from POST
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $SKU = $_POST['SKU'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];

        //Check for duplicate name
        $sql = $conn->query("SELECT Name FROM INVENTORY;");
        $names = $sql->fetchAll(PDO::FETCH_COLUMN);
        $sql = $conn->query("SELECT ProductSKU FROM INVENTORY;");
        $SKUs = $sql->fetchAll(PDO::FETCH_COLUMN);
        if (in_array($name, $names)) {
            $msg = "The name '$name' is already taken. Please choose a different one.";
            echo "<div class='alert alert-danger alert-dismissable fade in' role='alert'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    $msg
                </div>";
        }
        //Check for duplicate SKU
        elseif (in_array($SKU, $SKUs)) {
            $msg = "The product SKU '$SKU' is already taken. Please choose a different one.";
            echo "<div class='alert alert-danger alert-dismissable fade in' role='alert'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    $msg
                </div>";
        } 
        //Insert values into INVENTORY table
        else {
            $conn->query("INSERT INTO INVENTORY (name, productSKU, price, itemdesc) VALUES ('$name', $SKU, $price, '$desc');");
            $msg = "Added to inventory successfully.";
            echo "<div class='alert alert-success alert-dismissable fade in' role='alert'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    $msg
                </div>";
        }
    }
?>

</body>
</html>