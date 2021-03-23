<?php
    session_start();
?>
@extends('layout')

@section('title')
FAQ
@stop

@section('content')
<main class="flex" id="wrapper">
<div class="w3-container">
    <div class="w3-gray-blue">
        <h2 class="w3-center">What is Nuts and Bolts?</h2>
    </div>

    <div class="column side">
      <div class="w3-blue-gray" style="text-align:center;">
          <h2>FAQ</h2>
      </div>
      <p>How is it possible you stay open for 24/7/365?</p>
      <p>Honestly I have no idea. It just works.</p>
    </div>

    <div class="column middle">
      <div class="w3-blue-gray" style="text-align:center;">
          <h2>How was Nuts and Bolts founded?</h2>
      </div>
      <p>     Nuts and Bolts is a company founded in 2021 by a team of highly intelligent, extremely successful, good looking hardware enthusiasts. On a snowy winter day, this team (Consisting of Yasmin, Andrew, Chitra, Nathan, Mas, Christine, Astrid, and Abdirizak)
        decided, enough is enough, today is the day we build the company the world deserves.</p>
      <br>
      <p>     They bickered, debated, and ultimately conlcuded that the website should be named "Nuts and Bolts" (somehow this name was chosen even though all 8 members disagreed) and should be a place anyone from all reaches can access and purchase parts and pieces for their project.</p>
    </div>

    <div class="column side">
      <div class="w3-blue-gray" style="text-align:center;">
          <h2>Store hours</h2>
      </div>
      <p>We're literally open 24/7. What more could you want. 4am early riser? We'll be there. 9pm on Thanksgiving and your table broke? We got you.</p>
    </div>
</div>
</main>
@stop
