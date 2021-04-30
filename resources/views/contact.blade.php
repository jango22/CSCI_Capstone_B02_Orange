<?php session_start(); ?>
@extends('layout')

@section('title')
Contact Us
@stop

@section('content')
<main class="flex">
    <div class="container-sm" id="wrapper">
	<div class="jumbotron-fluid container">
		<img src="https://i.imgur.com/uVymdir.png" height="120" width="120" title="Logo" alt="Logo" class="center">
	</div>

	<div class="w3-card-4 w3-blue-gray">
		<h2 class="w3-center">Contact US</h2>
	</div>   
        <h3>Where to Find Us?</h3>
	    <p>We are always open for any issues you have! Our phone line is always open!</p>
	    <p>Contact Us <br>Phone Number: 383-295-5524 <br>Email: nutsandboltsb02@gmail.com <br>Located at: 5469 South Ridsweth Rd, Marion OH, 39455 </p>
        
        <!-- Send email functionality (WIP) -->
        
        <!--<h2>Send e-mail to nutsandboltsb02@gmail.com:</h2>
    
        <form method="post">
            {{ csrf_field() }}

            <textarea name="message"></textarea>


            <input type="submit" name="button1"
                    class="button" value="Button1" />

        </form> -->

        <?php
            if(array_key_exists('button1', $_POST)) { 
            button1(); 
            } 
            function button1() { 
                require('./config/class.PHPMailer.php');
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
</main>
</div>
<footer class="w3-blue-gray" style="padding:5px;text-align:center;">     
  <p>Nuts and Bolts<br>
  <a href="mailto:nutsandboltsb02@gmail.com">nutsandboltsb02@gmail.com</a></p>
</footer>
</div>
@stop
