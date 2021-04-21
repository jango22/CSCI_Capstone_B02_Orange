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
  font-size: 20px;
  text-align: center;
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

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

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

    <!-- Weekly Report Output -->
    <div class="grid-container">
  <div class="grid-item">1</div>
  <div class="grid-item">2</div>
  <div class="grid-item">3</div>
  <div class="grid-item">4</div>
  <div class="grid-item">5</div>
  <div class="grid-item">6</div>
  <div class="grid-item">7</div>
  <div class="grid-item">8</div>
  <div class="grid-item">9</div>
</div>

</div>


    <?php
    if(isset($_POST['date'])) {
        if (date('w', strtotime($_POST['date']))  != 1) {
            echo "<script>alert('Error: Please enter a Monday.');</script>";
        }
        else {
            echo "-Insert Weekly Report Here-";
        }
    }
    ?>
</div>
@stop
