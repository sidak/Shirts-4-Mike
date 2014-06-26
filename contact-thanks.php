<?php
$pageTitle="Contact Mike";
$section="Contact";
include("inc/header.php");
?>
	<div class="section page">
			<div class="wrapper">
				<h1>Contact</h1>
				<p>Thanks for the mail! I&rsquo;ll be in touch shortly</p>
			</div>
		</div>
<?php
	// like in contact-process1.php
	//this approach shd not be used since on clicking back or refresh , the mail will be sent again 
	// which cld turn out to be harmful
	// so we will first send the mail and then redirect to a thanks page
	include("inc/footer.php"); 
?>

