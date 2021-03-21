<!DOCTYPE html>
<html>
<style>
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: slategrey;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

        input[type=submit]:hover {
            background-color: lightslategray;
        }
</style>
<body>

    <h3>Using CSS to style an HTML Form</h3>

    <div>
        <form method="post" id="loginform">
            @csrf
            <label for="fname">Username</label>
            <input type="text" id="uname" name="username" placeholder="Type your username">

            <label for="lname">Password</label>
            <input type="text" id="pwd" name="password" placeholder="Type a Password">

            <label for="lname">Confirm Password</label>
            <input type="text" id="cpwd" name="confirm" placeholder="Confirm your Password">

            <input type="submit" value="Submit">
        </form>
    </div>
    <?php
    $servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
    $username = "orangeadmin";
    $password = "capstone02";
    $dbname = "OrangeDB";
    $port = "1433";
    $conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $username, $password);

    //Ensure password has one Capital, number, and special character
    if(isset($_POST['submit'])){
        if(isset($_POST['uname']) and !empty($_POST['uname']) and isset($_POST['pwd']) and !empty($_POST['pwd'] and isset($_POST['cpwd']) and !empty($_POST['cpwd']) {
            $username = $_POST['uname'];
            $emp = "yes";
            $pass = $_POST['pwd'];
            $confirm = $_POST['cpwd'];
            
            //regex patterns for password
            $numPat = "[0-9]";
            $upper = "[A-Z]";
            $upperLower = "[A-Za-z]";
            $special = "/[`'\"~!@#$*()<>\|]/";
            //checks username for lowercase
          if (preg_match($upper, $uname) == 0) {

            //checks if password has appropriate values
            if(preg_match($numPat, $pass) == 0 and preg_match($upperLower, $pass) == 0 and preg_match($special, $pass) == 0) {

                //checks that passwords match
                if($pass == $confirm) {
                      $conn->query("INSERT INTO Users (username, password, is_employee) VALUES ('$username', '$pass', '$emp')");
                }
                else {
                    echo "Passwords do not match!";
                }
            }
            else {
                echo "Your password must contain atleast one capital, lowercase, and special character";
            }
          } 
          else {
            echo "username must be all lowercase";
          }
        }
        else {
            echo "you must set a username or password";
        }
    }

</body>
</html>


