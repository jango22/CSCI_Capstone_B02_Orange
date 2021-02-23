<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Button</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<!-- Test Comment -->

<body>
    
<h2>Click the Button!</h2>
<form method="POST">
@csrf
    <button name="click" class="click">Click me</button>
</form>
<br>

<?php
    //Connect to database
    $servername = "aa189btph88nlyp.cps316w6axpe.us-east-1.rds.amazonaws.com";
    $username = "orangeadmin";
    $password = "capstone02";
    $dbname = "OrangeDB";
    $port = "1433";
    $conn = new PDO("sqlsrv:Server=$servername,$port;Database=$dbname;", $username, $password); 

    //If the user clicked the button, send the time to the database
    if(isset($_POST['click'])){
        date_default_timezone_set('EST');
        $datetime = date("m/d/Y h:i:s a");
        $conn->query("INSERT INTO BUTTON2 (TimePressed) VALUES ('$datetime');");
    }

    //Retrieve the time the button was last pressed
    $PDOSelectBUTTON = $conn->query("SELECT TOP 1 * FROM dbo.BUTTON2 ORDER BY TimePressed DESC;");
    $result = $PDOSelectBUTTON->fetch(PDO::FETCH_ASSOC);
    echo "Time the button was last clicked: ";
    echo date("l jS \of F Y h:i:s A", strtotime($result["TimePressed"]));
?>

</body>
</html>