<!DOCTYPE html>
<html style="background-color: rgba(195,195,195);" lang="en">
<head>
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Third-party stylesheets -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" integrity="sha384-wGcDZTQxqZGwbGs+rK7nXEh5IxNHbeZ7ow3Mwv0wMkz0ZClwnb+OMG6qF+faMPPU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<!-- Third-party scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!-- Our stylesheets -->
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<!-- Navbar -->
<div class="w3-top">
	<div class="w3-bar w3-blue-gray w3-card">

		<!-- Navbar items that are always present -->
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
        <a href="/" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-fw fa-home"></i>Home</a>
		<a href="/products" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-shopping-basket"></i>Products</a>
		<a href="/contact" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-fw fa-envelope"></i>Contact Us</a>
		<a href="/faq" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-question-circle"></i>FAQ</a>
		<a href="/cart" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-shopping-cart"></i>Cart</a>
        
        <!-- Navbar items that are present when window size is too small -->
        <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
		    <a href="/" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-fw fa-home"></i>Home</a>
		    <a href="/products" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-shopping-basket"></i>Products</a>
		    <a href="/contact" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-fw fa-envelope"></i>Contact Us</a>
		    <a href="/faq" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-question-circle"></i>FAQ</a>
		    <a href="/cart" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-shopping-cart"></i>Cart</a>
        </div>
        
		<?php 
			if (isset($_SESSION['username'])) { 
				if ($_SESSION['usertype'] == 'admin') {
					/* Only show up for employee users */

					echo
					'<div class="dropdown show w3-bar-item w3-button w3-padding-large w3-hide-small">
                            <button onclick="myFunction()" class="dropbtn"><i class="fa fa-user"></i>Employee</button>
                                <div id="myDropdown" class="dropdown-content">
                                    <a href="/add">Add Product</a>
                                    <a href="/update">Update Product</a>
                                    <a href="/registeremployee">Add Employee</a>
                                    <a href="/discount">Add Discount</a>
									<a href="/report">Weekly Report</a>
                                </div>
                     </div>';

				}
				/* Only show up for users who are logged in */
                echo '<a href="/userhist" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-right">History</a>';
				echo '<a href="/logout" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-right">Log Out</a>';
				echo '<span href="" class="w3-bar-item w3-padding-large w3-hide-small w3-right">Welcome, ';
				echo $_SESSION["fname"];
				echo '!</span>';
			} 
			else {
				/* Only show up for users who are logged out */
				echo '<a href="/login" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-right"><i class="fa fa-user-o"></i>Login</a>';
				echo '<a href="/register" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-sign-in"></i>Register</a>';
			}
		?>
	</div>
</div>

<body>
@yield('content')
<br><br>
</body>
	<!-- Footer Content -->
	<footer class="w3-blue-gray" style="padding:5px;text-align:center;">     
	<p>Nuts and Bolts<br>
	<a href="mailto:nutsandboltsb02@gmail.com">nutsandboltsb02@gmail.com</a></p>
	</footer>
</html>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<script>
function myFunction() {
  var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1)
    {
        x.className += " w3-show";
    }
    else
    { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
