<html>
<head>
	<title>
	<?php echo $pageTitle ; 
		//$section="home"; // you can either use @ infront of $section or use the function isset()
	?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700" type="text/css">
	<link rel="shortcut icon" href="favicon.ico">
</head>
<body>

	<div class="header">

		<div class="wrapper">

			<h1 class="branding-title"><a href="./">Shirts 4 Mike</a></h1>

			<ul class="nav">
				<li class="shirts <?php if (isset($section) && $section == 'shirts') { echo 'on'; } ?>"><a href="shirts.php">Shirts</a></li>
				<li class="contact <?php if(isset($section) && $section=='contacts'){echo 'on';} ?>"><a href="contacts.php">Contact</a></li>
				<li class="cart"><a target="paypal" href="https://www.paypal.com/cgi-bin/webscr?cmd=_cart&amp;business=Q6NFNPFRBWR8S&amp;display=1">Shopping Cart</a></li>
				<!-- IT's a good idea to escape the ampersand by &amp; 
					also the code we got from paypal was of a form , we changed into a link sending the info by get
				You can add multiple GET variables to the web address with an ampersand.
				-->
			</ul>

		</div>

	</div>

	<div id="content">
