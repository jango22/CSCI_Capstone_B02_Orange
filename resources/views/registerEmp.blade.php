@extends('layout')

@section('title')
Update a Product
@stop

@section('content')
<h3>Employee Register Form</h3>

    <div>
        <form method="post" id="loginform">
            @csrf
            <label for="uname">Username</label>
            <input type="text" id="uname" name="uname" placeholder="Type your username"> <br><br>
            
            <label for="pwd">Password</label>
            <input type="text" id="pwd" name="pwd" placeholder="Type a Password"><br><br>

            <label for="cpwd">Confirm Password</label>
            <input type="text" id="cpwd" name="cpwd" placeholder="Confirm your Password"><br><br>

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
    if (isset($_POST['uname']) and !empty($_POST['uname']) and isset($_POST['pwd']) and !empty($_POST['pwd']) and isset($_POST['cpwd']) and !empty($_POST['cpwd'])) {
            $username = $_POST['uname'];
            $emp = "yes";
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
                      $conn->query("INSERT INTO Users (username, password, is_Employee) VALUES ('$username', '$pass', '$emp')");
                }
                else {
                    echo "Passwords do not match!";
                }
            }
            
         }   
    }
    
    else {
        echo "you must set a username and password";
    }
     
}
