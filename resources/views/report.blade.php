<?php session_start(); ?>
@extends('layout')

@section('title')
Weekly Report
@stop

@section('content')
<style>
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto auto auto auto auto;
}
.grid-item {
  background-color: #ddd;
  border: 1px solid rgba(0, 0, 0, 0.8);
  text-align: center;
}
.top-row{
  background-color: #687c8c;
}
</style>

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
?>

<?php
	//Connect to database
	$servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
	$username = "orangeadmin";
	$password = "capstone02";
	$dbname = "OrangeDB";
	$port = "1433";
	$conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $username, $password);
?>

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

    <!-- Page Header -->
	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">Weekly Report</h2>
	</div>
	<br>

    <!-- Input Date Form -->
    <form method="POST" id="searchsubmit">
    @csrf
        <div class="form-group row">
            <label for="searchSKUid:" class="col-sm-1 col-form-label">Choose Date (Must be Monday):</label>
            <div class="col-sm-3">
                <input type="date" name="date" id="date" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="descid" class="col-sm-1 col-form-label"></label>
            <div class="offset-sm-3 col-sm-9 indent">
                <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <br>

    <?php
    if(isset($_POST['date'])) {

        /* Generate header with dates (Mon-Sun) */
        $date = strtotime($_POST['date']);
        $Monday = date("M d", $date);
        $Tuesday = date("M d", strtotime("+1 day", $date));
        $Wednesday = date("M d", strtotime("+2 day", $date));
        $Thursday = date("M d", strtotime("+3 day", $date));
        $Friday = date("M d", strtotime("+4 day", $date));
        $Saturday = date("M d", strtotime("+5 day", $date));
        $Sunday = date("M d", strtotime("+6 day", $date));
        if (date('w', $date) != 1) {
            echo "<script>alert('Error: Please enter a Monday.');</script>";
        } else {
            echo "
            <div class='grid-container'>
                <div class='grid-item'></div>
                <div class='grid-item w3-blue-grey'><div>Monday</div><div>$Monday</div></div>
                <div class='grid-item w3-blue-grey'><div>Tuesday</div><div>$Tuesday</div></div>
                <div class='grid-item w3-blue-grey'><div>Monday</div><div>$Wednesday</div></div>
                <div class='grid-item w3-blue-grey'><div>Monday</div><div>$Thursday</div></div>
                <div class='grid-item w3-blue-grey'><div>Monday</div><div>$Friday</div></div>
                <div class='grid-item w3-blue-grey'><div>Monday</div><div>$Saturday</div></div>
                <div class='grid-item w3-blue-grey'><div>Monday</div><div>$Sunday</div></div>
            </div>";

            /* Generate array of products sold in the date range */
            $sql = $conn->query("SELECT productName,dateCreated,username,totalPrice FROM ORDERS WHERE dateCreated BETWEEN '2021-04-18' AND '2021-04-19';");
            $orders = $sql->fetchAll();
            $products = [];
            for ($i=0; $i < count($orders); $i++) {
                $productName = $orders[$i]['productName'];
                if (!in_array($productName, $products)) {
                    array_push($products, $productName);
                }
            }
            
            /* Echo a row for each product */
            for ($i=0; $i < count($products); $i++) {
                $productName = $products[$i];
                echo "
                <div class='grid-container'>
                    <div class='grid-item'>$productName</div>
                    <div class='grid-item'></div>
                    <div class='grid-item'></div>
                    <div class='grid-item'></div>
                    <div class='grid-item'></div>
                    <div class='grid-item'></div>
                    <div class='grid-item'></div>
                    <div class='grid-item'></div>
                </div>";
            }







        }
    }
    ?>
</div>
@stop
