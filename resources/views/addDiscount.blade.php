<?php session_start(); ?>
@extends('layout')

@section('title')
Add a Product
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
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }
</script>

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">Add a Product to Inventory</h2>
	</div>
	<br>


<form method="POST" enctype="multipart/form-data">
@csrf
    <label for="codeid" class="col-sm-1 col-form-label">Code Name:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="text" class="form-control" name="code" id="codeid" placeholder="Code Name" minlength="5" maxlength="15" style="width: 180px;" required><br><br>
    <br><br>
    
    <label for="minTot" class="col-sm-1 col-form-label addinput">Minimum Total:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="number" class="form-control" name="minTotal" id="minid" placeholder="Minimum Total" min="0" max="1000" size="20" style="width: 180px;" required><br><br>

    <label for="amtOff" class="col-sm-1 col-form-label addinput">Amount Off:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="number" step="0.01" class="form-control" name="amtOff" placeholder="Amount Off" id="amtid" min="0" max="9999999999" style="width: 180px;" required><br><br>
    
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <button type="submit" name="submit" class="btn btn-primary">Add Coupon</button>
</form>

<?php
    //Get values from POST
    if(isset($_POST['submit'])){
        $code = $_POST['code'];
        $min = $_POST['minTotal'];
        $amtOff = $_POST['amtOff'];
        //Check for duplicate name
        $sql = $conn->query("SELECT code FROM Discount;");
        $codes = $sql->fetchAll(PDO::FETCH_COLUMN);
        if (in_array($code, $codes)) {
            $msg = "The code name '$code' is already taken. Please choose a different one.";
            echo "<div class='alert alert-danger alert-dismissable fade in' role='alert'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    $msg
                </div>";
        } 
        //Insert values into INVENTORY table
        else {
            $conn->query("INSERT INTO Discount (code, minTotal, amtOff) VALUES ('$code', '$min', '$amtOff');");
            $msg = "The dsicount code hass been added succesfully and is ready to use!";
            echo "<div class='alert alert-success alert-dismissable fade in' role='alert'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    $msg
                </div>";
        }
    }
?>

</div>
<footer class="w3-blue-gray" style="padding:5px;text-align:center;">     
  <p>Nuts and Bolts<br>
  <a href="mailto:nutsandboltsb02@gmail.com">nutsandboltsb02@gmail.com</a></p>
</footer>
</div>
@stop
