<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add a Product</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<h2>Add a Product to Inventory</h2>
<form method="POST">
@csrf
    <button name="submit" class="submit">Submit</button>
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

?>

</body>
</html>