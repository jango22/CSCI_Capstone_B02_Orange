<!DOCTYPE html>
<html lang="en">
<head>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<div class="w3-top">
			<div class="w3-bar w3-green w3-card">
				<a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
				<a href="/" class="w3-bar-item w3-button w3-padding-large">HOME</a>
				<a href="/HProducts" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Products</a>
				<a href="/Contact" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Contact Us</a>
				<a href="/FAQ" class="w3-bar-item w3-button w3-padding-large w3-hide-small">FAQ</a>
				<a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>
			</div>
		</div>
		<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
			<a href="/HProducts" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Products</a>
			<a href="/Contact" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Contact Us</a>
			<a href="/FAQ" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">FAQ</a>
		</div>
		<br> <br>
		<title>HardCode Products</title>

		<div class="jumbotron-fluid container">
			<header>
				<img src="https://i.imgur.com/uVymdir.png" height="150" width="150" title="Logo" alt="Logo" class="center">
			</header>
		</div>

</head>
<body>
			
			<div >	
<main class="flex">
		<div class="content container" id="wrapper">
     <h1>Contact Us</h1>      
	<h3>Where to Find Us?</h3>
	    <p>We are always open for any issues you have! Our phone line is always open!</p>
	    <p>Contact Us <br>Phone Number: 383-295-5524 <br>Email: nutsandboltsb02@gmail.com <br>Located at: 5469 South Ridsweth Rd, Marion OH, 39455 </p>
        <h2>Send e-mail to nutsandboltsb02@gmail.com:</h2>
    
    <form method="post">
        {{ csrf_field() }}

        <textarea name="message"></textarea>


        <input type="submit" name="button1"
                class="button" value="Button1" />

    </form>
   <?php
    
    
if(array_key_exists('button1', $_POST)) { 
   button1(); 
  } 
function button1() { 
    require('../config/class.PHPMailer.php');
    $mail=new PHPMailer();
    $mail->CharSet = 'UTF-8';

    $body = 'This is the message';

    $mail->IsSMTP();
    $mail->Host       = 'smtp.gmail.com';

    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = true;

    $mail->Username   = 'nutsandboltsb02@gmail.com';
    $mail->Password   = 'Capstone02';

    $mail->SetFrom('nandbCustComplaint@gmail.com', $name);
    $mail->Subject    = 'TEST';
    $mail->MsgHTML($body);

    $mail->AddAddress('nandbCustComplaint@gmail.com', 'title1');

    $mail->send();
} 
    ?>
	</div>
	</div>
 	</main>
    
 </body>
<footer>
</footer>
</html>

