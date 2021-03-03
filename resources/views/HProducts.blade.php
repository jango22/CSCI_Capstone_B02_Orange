<!DOCTYPE html>
<html lang="en">
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
				<a href="HomePg.html" class="w3-bar-item w3-button w3-padding-large">HOME</a>
				<a href="HProducts.html" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Products</a>
				<a href="ContUs.html" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Contact Us</a>
				<a href="FAQ.html" class="w3-bar-item w3-button w3-padding-large w3-hide-small">FAQ</a>
				<a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>
			</div>
		</div>
		<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
			<a href="HProducts.html" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Products</a>
			<a href="ContUs.html" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Contact Us</a>
			<a href="FAQ.html" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">FAQ</a>
		</div>
		<br> <br>
		<title>HardCode Products</title>

		<div class="jumbotron-fluid container">
			<header>
				<img src="pics/ndolt.png" height="150" width="150" title="Logo" alt="Logo" class="center">
			</header>
		</div>

</head>

<body style="background-color:lightgray;">
	<main class="flex"  id="wrapper" style="background-color:lightgray">
		<div class="w3-container">
			<div class="w3-card-4 w3-orange">
				<h2 class="w3-center">Products List</h2>
			</div>
			<input type="text" id="myInput" onkeyup="tableSearch()" placeholder="Search for products .." title="Type in a name">
			<ul id="myUL" class="w3-ul w3-card-4" style="background-color:lightgray">
				<li class="w3-bar w3-hover-blue">
						<span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">×</span>
						<img src="https://i.imgur.com/N6Vx3Or.jpg" class="w3-bar-item w3-hide-small" style="width: 125px; height: 125px; ">
						<div class="w3-bar-item w3-left">
							<h3>Hammer</h3>
							<span>This is a hammer. May cause spontaneous bursts of lightning. Trust us, its a feature.</span> <br>
							<span>$999.50</span>
						</div>
				</li>
				<li class="w3-bar w3-hover-red">
						<span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">×</span>
						<img src="https://i.imgur.com/mFOndyT.jpeg" class="w3-bar-item w3-hide-small" style="width: 125px; height: 125px; ">
						<div class="w3-bar-item" style="float:left;">
							<h3>Glue</h3>
							<span>If you want to bind two things together, use this. Seriously, they wont come apart. DISCLAIMER: Sniffing this stuff will drop you quicker than a Tyson right hook.</span><br>
							<span>$40.00</span>
						</div>
				</li>
				<li class="w3-bar w3-hover-green">
					<span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">×</span>
					<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQexuifPTPeYz2hKSAbtGBhgU6NSGrQrtbh7w&usqp=CAU" class="w3-bar-item w3-hide-small" style="width:125px; height:125px;">
					<div class="w3-bar-item">
						<h3>Light Bulb</h3>
						<span>Okay, okay. It's not a light bulb, its techincally a lantern thats a ring. BUT! With this lantern/ring thing, all things are possible.</span>
						<br>
						<span>$00.25</span>
					</div>
				</li>
				<li class="w3-bar w3-hover-yellow">
					
					<span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">×</span>
					<img src="https://www.mccoys.com/images/8ecf916f-26e1-4a1a-9579-535c2d4c5943/400" class="w3-bar-item w3-hide-small" style="width:125px; height:125px;">
					<div class="w3-bar-item">
						<h3>Just a 2x4</h3>
						<span>Nothing to see here. It's a 2x4...</span><span class="w3-small">or is it?....</span>
						<br>
						<span>$02.40</span>
					</div>
				</li>
			</ul>
		</div>
</body>

<footer>
</footer>
<script>
    function tableSearch() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
		li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("h3")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
	function myFunction() {
		var x = document.getElementById("navDemo");
		if (x.className.indexOf("w3-show") == -1) {
			x.className += " w3-show";
		}
		else {
			x.className = x.className.replace(" w3-show", "");
		}
	}
</script>
</html>