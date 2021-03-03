<!DOCTYPE html>
<html lang="en">
<head>
	<title>FAQ</title>
	
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="icon" href="pics/ndolts.ico" type="fav/ico">
		<div class="jumbotron-fluid">
		<div class="container">
		
			<!--Banner for website-->	
			
		<header>
		
      <img class="feature" src = "https://i.imgur.com/uVymdir.png" height ="100" width ="100" title="Logo" alt="Logo">
		<h1>Nuts &#38; Bolts</h1>
		
		  </div>
		  </div>
		  
	</header>
	
	<!--Navigation Bar-->
			<nav>
	<ul>
	<li><a href="HomePg.html">Home</a></li>
	<li><a href="HProducts.html">HardCode Products</a></li>
	<li><a href="ContUs.html">Contact Us</a></li>
	<li><a href="FAQ.html">FAQ</a></li>
	</ul>
			</nav>
			
			<div id="wrapper">
	<!--Main Body for Website-->

	<body>
		<main class="flex">
			<div class="container">
	<h3>FAQ</h3>
  
                
          <!-- FQA START HERE -->
                
     <script> <!-- FQA Script START HERE -->   
var ButtonExpand = function (domNode) {

  this.domNode = domNode;

  this.keyCode = Object.freeze({
    'RETURN': 13
  });
};

ButtonExpand.prototype.init = function () {

  this.controlledNode = false;

  var id = this.domNode.getAttribute('aria-controls');

  if (id) {
    this.controlledNode = document.getElementById(id);
  }

  this.domNode.setAttribute('aria-expanded', 'false');
  this.hideContent();

  this.domNode.addEventListener('keydown',    this.handleKeydown.bind(this));
  this.domNode.addEventListener('click',      this.handleClick.bind(this));
  this.domNode.addEventListener('focus',      this.handleFocus.bind(this));
  this.domNode.addEventListener('blur',       this.handleBlur.bind(this));

};

ButtonExpand.prototype.showContent = function () {

  if (this.controlledNode) {
    this.controlledNode.style.display = 'block';
  }

};

ButtonExpand.prototype.hideContent = function () {

  if (this.controlledNode) {
    this.controlledNode.style.display = 'none';
  }

};

ButtonExpand.prototype.toggleExpand = function () {

  if (this.domNode.getAttribute('aria-expanded') === 'true') {
    this.domNode.setAttribute('aria-expanded', 'false');
    this.hideContent();
  }
  else {
    this.domNode.setAttribute('aria-expanded', 'true');
    this.showContent();
  }

};

/* EVENT HANDLERS */

ButtonExpand.prototype.handleKeydown = function (event) {

  console.log('[keydown]');

  switch (event.keyCode) {

    case this.keyCode.RETURN:

      this.toggleExpand();

      event.stopPropagation();
      event.preventDefault();
      break;

    default:
      break;
  }

};

ButtonExpand.prototype.handleClick = function (event) {
  this.toggleExpand();
};

ButtonExpand.prototype.handleFocus = function (event) {
  this.domNode.classList.add('focus');
};

ButtonExpand.prototype.handleBlur = function (event) {
  this.domNode.classList.remove('focus');
};

/* Initialize Hide/Show Buttons */

window.addEventListener('load', function (event) {

  var buttons =  document.querySelectorAll('button[aria-expanded][aria-controls]');

  for (var i = 0; i < buttons.length; i++) {
    var be = new ButtonExpand(buttons[i]);
    be.init();
  }

}, false);</script>   <!-- FQA Script END HERE --> 
        
        
        
        
       <dl class="faq">
  <dt>
    <button aria-expanded="false" aria-controls="faq1_desc">
      Store hours?
    </button>
  </dt>
  <dd>
      

 <table id="faq1_desc" class="desc">
<tr><th>Sunday</th><td>Closed</td></tr>
<tr><th>Monday</th><td>9am - 5pm</td></tr>
<tr><th>Tuesday</th><td>9am - 5pm</td></tr>
<tr><th>Wednesday</th><td>9am - 5pm</td></tr>
<tr><th>Thursday</th><td>9am - 5pm</td></tr>
<tr><th>Friday</th><td>9am - 5pm</td></tr>
<tr><th>Saturday</th><td>9am - 5pm</td></tr>
</table>
  </dd>
    
        
  <dt>
    <button aria-expanded="false" aria-controls="faq2_desc">
      Return Policy?
    </button>
  </dt>
  <dd>
      
    <h6 id="faq2_desc" class="desc"> We accept return and cancellations under the following conditions:
      
      <ul id="faq2_desc" class="desc">
  <li>Contact me within: 7 days of delivery</li>
  <li>Ship items back within: 14 days of delivery</li>
  <li>Request a cancellation within: 24 hours of purchase</li>
</ul> 
      </h6> 
  </dd>
           
  <dt>
    <button aria-expanded="false" aria-controls="faq3_desc">
      Why the owner created the first Nuts and Bolts store?
    </button>
  </dt>
  <dd>
    <p id="faq3_desc" class="desc">
      To let the customer do shopping 24/7. 
    </p>
  </dd>  
   <!-- FQA END HERE -->               
                               
<footer>
</footer>
</html>