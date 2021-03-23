<?php
    session_start();
?>
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
</script>
<h2>Login</h2>
    <form method="post">
    @csrf
        <label for="username">Username</label><br>
        <input type="text" id="uname" name="uname"><br>
        <label for="password">Password</label><br>
        <input type="text" id="pwd" name="pwd"><br><br>
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
       document.getElementById("submit").disabled = true; </script>'
    }
    else {
    
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
            $sql3 = $conn -> query ("SELECT is_Employee FROM Users WHERE username = '$username'");
            $emp = $sql3->fetchAll(PDO::FETCH_ASSOC)[0];
            $sql4 = $conn -> query ("SELECT fname FROM Users WHERE username = '$username'");
            $name = $sql4->fetchAll(PDO::FETCH_ASSOC)[0];
            //checks if username and password is in database
            if (in_array($username, $usernames) && in_array($pass, $pwds)) {
                $_SESSION['username'] = $username;
                $_SESSION['fname'] = $name['fname'];
                $_SESSION['isEmp'] = $emp['is_Employee'];
                unset($_SESSION['attempts']);
                if ($_SESSION['isEmp'] == 'yes') {
                    $_SESSION['usertype'] = 'admin';
                }
                else {
                    $_SESSION['usertype'] = 'user';
                }
                header("Location: http://capstoneclass-php.eba-c2wjtm2e.us-east-1.elasticbeanstalk.com/");
            }
            else {
                if(isset($_SESSION['attempts'])) {
                    $_SESSION['fail'] = $_SESSION['attempts']++; //increment 
                    if ($_SESSION['fail'] >= 2) {
                        setcookie('block', $_SESSION['fail'], time() + (60 * 15),'/'); //15 minutes            
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
