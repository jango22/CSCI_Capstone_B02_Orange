  <h3>Employee Register Form</h3>

    <div>
        <form method="post" id="loginform">
            @csrf
            <label for="fname">Username</label>
            <input type="text" id="uname" name="uname" placeholder="Type your username"> <br><br>
            
            <label for="lname">Password</label>
            <input type="text" id="pwd" name="pwd" placeholder="Type a Password"><br><br>

            <label for="lname">Confirm Password</label>
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

    //Ensure password has one Capital, number, and special character
 if(isset($_POST['submit'])){
    if(isset($_POST['uname']) and !empty($_POST['uname']) and isset($_POST['pwd']) and !empty($_POST['pwd']) and isset($_POST['cpwd']) and !empty($_POST['cpwd'])) {
            $username = $_POST['uname'];
            $emp = "yes";
            $pass = $_POST['pwd'];
            $confirm = $_POST['cpwd'];
            
            $numPat = "[0-9]";
            $upper = "[A-Z]";
            $upperLower = "[A-Za-z]";
            $special = "/[`'\"~!@#$*()<>\|]/";

            //checks if password has appropriate values
            if (preg_match('^.*(?=.{7,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$', $pass)) {

                //checks that passwords match
                if($pass == $confirm) {
                      $conn->query("INSERT INTO Users (username, password, is_Employee) VALUES ('$username', '$pass', '$emp')");
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
            echo "you must set a username or password";
        }
    }
