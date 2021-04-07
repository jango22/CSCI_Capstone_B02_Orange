<?php session_start(); ?>
@extends('layout')

@section('title')
Login
@stop

@section('content')
<script>
    function disableTries(){
        document.getElementById('uname').disabled = true;
        document.getElementById('pwd').disabled = true;
        document.getElementById('submit').disabled = true;
        setTimeout(function(){
        document.getElementById('uname').disabled = false;
        document.getElementById('pwd').disabled = false;
        document.getElementById('submit').disabled = false;},900000);
    }
    function togglePassword() {
        var x = document.getElementById("pwd");
        if (x.type === "password") { x.type = "text"; }
        else { x.type = "password"; }
    }
</script>
<div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">Login</h2>
	</div>     
    
<h2>Login</h2>
    <form method="post">
    @csrf
        <label for="username">Username</label><br>
        <input type="text" id="uname" name="uname"><br>
        <label for="password" >Password</label><br>
        <input type="password" id="pwd" name="pwd"><br>
        <input type="checkbox" onclick="togglePassword()"> Show Password<br><br>
        <input type="submit" id='submit' name="submit" value="Submit">
    </form>

    <?php
    //connection block
    $servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
    $user = "orangeadmin";
    $password = "capstone02";
    $dbname = "OrangeDB";
    $port = "1433";
    $conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $user, $password);
   if (isset($_COOKIE['block'])) {
       echo "Too many attempts! You will be locked out for 15 minutes!";
       echo '<script> document.getElementById("uname").disabled = true;
       document.getElementById("pwd").disabled = true;
       document.getElementById("submit").disabled = true; </script>';
    }
    else {
    echo '<script> document.getElementById("uname").disabled = false;
       document.getElementById("pwd").disabled = false;
       document.getElementById("submit").disabled = false; </script>';
    }
    //Retrieve Login values from form
    if(isset($_POST['submit'])) {
        if (isset($_POST['uname']) and isset($_POST['pwd'])) {
            $username = $_POST['uname'];
            $pass = $_POST['pwd'];


            $sql1 = $conn -> query("SELECT username FROM Users;");
            $usernames = $sql1->fetchAll(PDO::FETCH_COLUMN);
            $sql2 = $conn->query("SELECT password FROM Users;");
            $pwds = $sql2->fetchAll(PDO::FETCH_COLUMN);
            
            //checks if username and password is in database
            if (in_array($username, $usernames) && in_array($pass, $pwds)) {
                $sql3 = $conn -> query ("SELECT is_Employee FROM Users WHERE username = '$username'");
                $emp = $sql3->fetchAll(PDO::FETCH_ASSOC)[0];
                $sql4 = $conn -> query ("SELECT fname FROM Users WHERE username = '$username'");
                $name = $sql4->fetchAll(PDO::FETCH_ASSOC)[0];
                $sql5 = $conn -> query ("SELECT userID FROM Users WHERE username = '$username'");
                $userID = $sql5->fetchAll(PDO::FETCH_ASSOC)[0];
                
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $userID['userID'];
                $_SESSION['fname'] = $name['fname'];
                $_SESSION['isEmp'] = $emp['is_Employee'];
                unset($_SESSION['attempts']);
                if ($_SESSION['isEmp'] == 'yes') {
                    $_SESSION['usertype'] = 'admin';
                }
                else {
                    $_SESSION['usertype'] = 'user';
                }
                header("Location: /");
            }
            else {
            echo 'Your username and password are incorrect';
                if(isset($_SESSION['attempts'])) {
                    $_SESSION['fail'] = $_SESSION['attempts']++; //increment 
                    if ($_SESSION['fail'] >= 2) {
                        setcookie('block', $_SESSION['fail'], time() + (60 * 15),'/'); //15 minutes 
                        unset($_SESSION['attempts']);
                    }
                } 
                else {
                    $_SESSION['attempts'] = 1;
                }
            }

        }
        else {
            echo "You must enter a username and password!";
        }
    }
    
    ?>
    @stop
