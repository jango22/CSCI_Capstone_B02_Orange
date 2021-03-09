<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html style="background-color: rgba(195,195,195);" lang="en">
<head>
	
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<div class="w3-top">
			<div class="w3-bar w3-blue-gray w3-card">
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
		
</head>
			
			<div id="w3-wrapper">
	<!--Main Body for Website-->

	<body>
		<main class="flex">
			<div class="container">
            <br>
            <br>
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
