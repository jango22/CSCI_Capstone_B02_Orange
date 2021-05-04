<?php session_start(); ?>
@extends('layout')

@section('title')
Add a Discount Code
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

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">Add a Discount Code</h2>
	</div>
	<br>


<form method="POST" enctype="multipart/form-data">
@csrf
    <label for="codeid" class="col-sm-1 col-form-label">Code Name:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="text" class="form-control" name="code" id="codeid" placeholder="Code Name" minlength="5" maxlength="15" style="width: 180px;" required><br><br>
    
    <label for="minTot" class="col-sm-1 col-form-label addinput">Minimum Total:</label>&nbsp&nbsp&nbsp&nbsp
    <input type="number" class="form-control" name="minTotal" id="minid" placeholder="Minimum Total" min="0" max="1000" size="20" style="width: 180px;" required><br><br>

    <label for="amtOff" class="col-sm-1 col-form-label addinput">Amount Off:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="number" step="0.01" class="form-control" name="amtOff" placeholder="Amount Off" id="amtid" min="0" max="9999999999" style="width: 180px;" required><br><br>
    
    <label for="startDate" class="col-sm-1 col-form-label addinput">Start Date:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="date" name="start" id="startdate" required><br><br>

    <label for="endDate" class="col-sm-1 col-form-label addinput">End Date:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="date" name="end" id="enddate" required>
    <br><br>
    
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <button type="submit" name="submit" class="btn btn-primary">Add Code</button>
    
</form>

<?php
    //Get values from POST
    if(isset($_POST['submit'])){
        $code = $_POST['code'];
        $min = $_POST['minTotal'];
        $amtOff = $_POST['amtOff'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        //Check for duplicate name
        $sql = $conn->query("SELECT code FROM Discount;");
        $codes = $sql->fetchAll(PDO::FETCH_COLUMN);
        if (in_array($code, $codes)) {
            echo "<script>alert('The code name $code is already taken. Please choose a different one.');</script>";
        } 
        //Insert values into INVENTORY table
        else {
            $conn->query("INSERT INTO Discount (code, minTotal, amtOff, startDate, endDate) VALUES ('$code', '$min', '$amtOff', '$start', '$end');");
            echo "<script>alert('The discount code has been added succesfully and is ready to use!');</script>";
        }
    }
?>
</div>
@stop
