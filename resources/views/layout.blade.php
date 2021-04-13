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

	<!-- Our stylesheets -->
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<!-- Navbar -->
<div class="w3-top">
	<div class="w3-bar w3-blue-gray w3-card">

		<!-- Navbar items that are always present -->
		<a href="/" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-fw fa-home"></i>Home</a>
		<a href="/products" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-shopping-basket"></i>Products</a>
		<a href="/contact" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-fw fa-envelope"></i>Contact Us</a>
		<a href="/faq" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-question-circle"></i>FAQ</a>
		<a href="/cart" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-shopping-cart"></i>Cart</a>

		<?php 
			if (isset($_SESSION['username'])) { 
				if ($_SESSION['usertype'] == 'admin') {
					/* Only show up for employee users */

					echo
					'<div class="dropdown show w3-bar-item w3-button w3-padding-large w3-hide-small">
						<a class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Employee Only<i class="fa fa-caret-down"></i>
						</a>

						<div id="myDropdown" class="dropdown-content">
                            <a href="#home">Home</a>
                            <a href="#about">About</a>
                            <a href="#contact">Contact</a>
                        </div>
					</div>';

					/* echo '<a href="/registeremployee" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Register Employee</a>'; 
					echo '<a href="/add" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Add Product</a>';
					echo '<a href="/update" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Update Product</a>'; */

				}
				/* Only show up for users who are logged in */
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
