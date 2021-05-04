<?php session_start(); ?>
@extends('layout')

@section('title')
Register
@stop

@section('content')
<!-- Make sure user is not logged in -->
<?php 
if(isset($_SESSION['username'])){
    die(header("Location: /"));
}
?>

<script>
    function togglePassword() {
            var x = document.getElementById("pwd");
            if (x.type === "password") { x.type = "text"; }
            else { x.type = "password"; }
            var y = document.getElementById("cpwd");
            if (y.type === "password") { y.type = "text"; }
            else { y.type = "password"; }
        }
</script>

<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">Register!</h2>
	</div>  
	<h2>Register</h2> 



    <div>
        <form method="post" id="loginform">
            @csrf
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" placeholder="Type your first name"> <br><br>
            
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" placeholder="Type your last name"> <br><br>
            
            <label for="uname">Username:</label>
            <input type="text" id="uname" name="uname" placeholder="Type your username"> <br><br>
            
            <label for="pwd">Password:</label>
            <input type="password" id="pwd" name="pwd" placeholder="Type a password"><br><br>

            <label for="cpwd">Confirm Password:</label>
            <input type="password" id="cpwd" name="cpwd" placeholder="Confirm your password"><br>
            <input type="checkbox" onclick="togglePassword()"> Show Password<br><br>
            

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <?php

    $servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
    $user = "orangeadmin";
    $password = "capstone02";
    $dbname = "OrangeDB";
    $port = "1433";
    $conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $user, $password);

if (isset($_POST['submit'])){
    if (isset($_POST['uname']) and !empty($_POST['uname']) and isset($_POST['pwd']) and !empty($_POST['pwd']) and isset($_POST['cpwd']) and !empty($_POST['cpwd']) and isset($_POST['fname']) and !empty($_POST['fname']) and isset($_POST['lname']) and !empty($_POST['lname'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $username = $_POST['uname'];
            $emp = "No";
            $pass = $_POST['pwd'];
            $confirm = $_POST['cpwd'];
       //checks username format
       if (preg_match('~[A-Z]+~', $username)) {
            echo "Your username cannot have uppercase!";
       }
       else if (preg_match('~[0-9]+~', $username)) {
            echo "Your username cannot have a number!";
       }
       else if (preg_match('~[^a-zA-Z\d]+~', $username)) {
            echo "Your username cannot have a special character or whitespace!";
       }
       else {

            //checks if password has appropriate values
            if (!preg_match('~[0-9]+~', $pass)) {
               echo "Your password must contain a number. You must also have a lower case, upper case, and special character.";               
            }
             
            else if (!preg_match('~[A-Z]+~',$pass)) {
                echo "Your password doesnt have a capital letter. You must also have a number, lower case letter and special character.";
            }
            
            else if (!preg_match('~[a-z]+~',$pass)) {
                echo "Your password doesnt have a lower case letter. You must also have a number, upper case letter and special character.";
            }
            
            else if (!preg_match('~[^a-zA-Z\d]+~',$pass)) {
                echo "Your password doesnt have a special character. You must also have a number, lower case, and upper case letter.";
            }
            
            else {
                
                if($pass == $confirm) {
                      $conn->query("INSERT INTO Users (username, password, is_Employee, fname, lname) VALUES ('$username', '$pass', '$emp', '$fname', '$lname')");
                      echo "<script>alert('Registration Succesful, Click OK to Log in. Thanks!'); window.location.href='/login';</script>";
                }
                else {
                    echo "Passwords do not match!";
                }
            }
            
         }   
    }
    
    else {
        echo "You must set a first name, last name, username, and password";
    }
     
}
?>
@stop
