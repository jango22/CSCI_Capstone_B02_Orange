﻿<?php
// Start the session
session_start();
?>

    <form method="post">
    @csrf
        <label for="username">Username</label><br>
        <input type="text" id="uname" name="uname"><br>
        <label for="password">Password</label><br>
        <input type="text" id="pwd" name="pwd"><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    //connection block
    $servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
    $user = "orangeadmin";
    $password = "capstone02";
    $dbname = "OrangeDB";
    $port = "1433";
    $conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $user, $password);

    //Retrieve Login values from form
    if(isset($_POST['submit'])) {
        if (isset($_POST['uname']) and isset($_POST['pwd'])) {
            $username = $_POST['uname'];
            $pass = $_POST['pwd'];


            $sql1 = $conn -> query("SELECT username FROM Users;");
            $usernames = $sql1->fetchAll(PDO::FETCH_COLUMN);
            $sql2 = $conn->query("SELECT password FROM Users;");
            $pwds = $sql2->fetchAll(PDO::FETCH_COLUMN);
            $sql3 = $conn -> query ("SELECT is_Employee WHERE username = '$username'");
            //checks if username and password is in database
            if (in_array($username, $usernames) && in_array($pass, $pwds)) {
                $_SESSION['username'] = $username;
                $_SESSION['isEmp'] = $sql3;
                if ($_SESSION['isEMP'] = 'yes') {
                    $_SESSION['usertype'] = 'admin';
                }
                else {
                    $_SESSION['usertype'] = 'user';
                }
                header("Location: http://capstoneclass-php.eba-c2wjtm2e.us-east-1.elasticbeanstalk.com/");
            }
            else {
                echo "Username or password is incorrect";
            }

        }
        else {
            echo "You must enter a username and password!";
        }
    }
    ?>
    </div>