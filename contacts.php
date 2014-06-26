<?php 
require_once('inc/phpmailer/class.phpmailer.php');
$mail=new PHPMailer();
$errors= array(1 => "you must specify a value for name, email and message.",
					2 => "there was problem with ur info", 
					3 => "ur form submission has an error",
					4 => "enter a valid email id"
					);
$error=false;				
function add_error($index, $value){
	global $errors;
	$errors[$index]=$value;
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$name = trim($_POST["name"]);// removes forward and backward extra spaces
	$email = trim($_POST["email"]);
	$message = trim($_POST["message"]);
	
	
	
	if($name=="" OR $message=="" OR $email==""){
		$flag=1;
		$error=true;
		//header("Location: contacts.php?error=$flag");
		//exit;
		
	} 
	
	//email injection prevention
	
		if (isset($error) AND $error!=true){
			foreach($_POST as $value){
				if(stripos($value,'Content-Type:')!==FALSE){
					$flag=2;
					$error=true;
					//header("Location: contacts.php?error=$flag");
					//exit;
					//what is !==
					// are boolean TRUE / FALSE need to be in capital
					//check out:
					// nyphp.org/phundamentals/8_Preventing-Email-Header-Injection 
					// for the above func
				}
			}
		}
	
	// using 3rd party lib phpmailer to send the mail
	// with files that create new functions use : require_once()
	//copy the class.phpmailer.php to our htdocs direc
	// the diff b/w include and require is that if include file is not there , php will warn us but still display the next
	// but in case of require , it wont display any further
	if (isset($error) AND $error!=true){
		if($_POST["address"]!=""){
		// as the spammer robots use direct html
			$flag=3;
			$error=true;
			//header("Location: contacts.php?error=$flag");
			//exit;
		}
	}
	
	//require_once('inc/phpmailer/class.phpmailer.php');
	//$mail=new PHPMailer();
	if (isset($error) AND $error!=true){
		if(!$mail->ValidateAddress($email)){
			$flag=4;
			$error=true;
			//header("Location: contacts.php?error=$flag");
			//exit;
		}
	}
	if (isset($error) AND $error!=true){
		$email_body="";
		//Since we'll be sending an HTML email, we actually do need HTML tags
		//for the hard returns in the email body instead of the PHP escape characters.
		$email_body.= "Name: ".$name."<br>";
		$email_body.= "Email: ".$email."<br>";
		$email_body.= "Message: ".$message;

		// TODO send an email
		//$body = file_get_contents('contents.html');
		//$body = preg_replace('/[\]/','',$body);
		//these two lines get the body of the mail from a html file
		
		$mail->SetFrom($email,$name);
		//sets the email of the person who sent the mail
		// we really dont need addtoreply since by default our site's email clients will reply to the form address
		//$mail->AddReplyTo($email,$name);
		//by email client we mean gmail or hotmail

		$address = "order@shirts4mike.com";
		$mail->AddAddress($address, "Shirts 4 Mike");

		$mail->Subject = "Contact form submission |".$name;
		// only for those whose email client don't support html
		//$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mail->MsgHTML($email_body);
		
		$mail->AddAttachment("images/phpmailer.gif");      // attachment
		$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

		if(!$mail->Send()) {
			
			
				 
			$temp= "Mailer Error: " . $mail->ErrorInfo;// errorinfo is a property
			add_error(5, $temp);
			$flag=5;
			$error=true;
			//header("Location: contacts.php?error=$flag");
			//exit;
		}
	} 
	//else {
	//echo "Message sent!";
	//}
	//but I also recommend using a separate mail server.
	//The code as we have it written right now uses the web server itself to send the email.
	//This code probably won't work on your local server,but there's a pretty
	// good chance that it will work on your production server.
	//You'll have to deploy it and test it to find out for sure.
	//Even if it works though, it's still a much better practice to use a separate mail server.
	//Email providers take spam very seriously,and your server could get flagged as a spam server if your site
	//or another site on your server gets compromised.If that were to happen, your form submission emails might get blocked
	//or they might skip your inbox and go to a spam folder.
	//It takes a little extra effort to set it up, but using a separate mail server is definitely the right way to go.
	// use ftp client cyberduck.ch
	// also edit paypal custom page style settings for the checkout page
	if (isset($error) AND $error!=true){
			header("Location: contacts.php?status=thanks");
			exit;//good practice
	}
	
}
?>
<?php 
$pageTitle="Contact Mike";
$section="contacts";
include("inc/header.php");
// the default value of the action attribute is the page itself
?>

		<div class= "section page">
			<div class="wrapper">
				<h1>
					Contact
				</h1> 
				
				<?php if(isset($_GET["status"]) AND $_GET["status"]=="thanks"){ ?>
						<p>Thanks for the mail! I&rsquo;ll be in touch shortly</p>
				<?php } ?>
				<?php
					if(isset($error) AND $error){
						if(isset($flag)){
							$p_text= '<center><p style="color:#9c9f4e;">'.$errors[$flag]."</p></center><p>"."I&rsquo;d love to hear from you! Complete the form to send an email"."</p>"; 
						}
					}
					else {
							$p_text="<p>"."I&rsquo;d love to hear from you! Complete the form to send an email"."</p";
					}
				
				/*	global $errors;
					if (isset($_GET["error"]) AND isset($errors) AND isset($errors[$_GET["error"]])){ 
							$p_text= '<center><p style="color:#9c9f4e;">'.$errors[$_GET["error"]]."</p></center><p>"."I&rsquo;d love to hear from you! Complete the form to send an email"."</p>"; 
						}
						else {
							$p_text="<p>"."I&rsquo;d love to hear from you! Complete the form to send an email"."</p";
						}
				?>*/
				?>
					<p><?php if(isset($p_text)) echo $p_text; ?>
					
					</p>
					<form method="post" action="contacts.php">
						<table>
							<tr>
								<th><label for="name">Name</label></th>
								<td><input type="text" name="name" id="name" value='<?php if(isset($_POST["name"])) echo htmlspecialchars($_POST["name"]);?>' ></td>
							</tr>
							<tr>
								<th><label for="email">Email</label></th>
								<td><input type="text" name="email" id="email"  value='<?php if(isset($_POST["email"])) echo htmlspecialchars($_POST["email"]);?>'></td>
							</tr>
							<tr>
								<th><label for="message">Message</label></th>
								<td><textarea name="message" id="message">
									<?php 
										if(isset($_POST["message"])) echo htmlspecialchars($_POST["message"]);
										else echo "Write Here...";
									?>
									</textarea>
								</td>
							</tr>
							<tr style="display:none;">
								<th><label for="address">address</label></th>
								<td>
									<input type="text" name="address" id="address">
									<p>humans pls leave it out!!</p>
								</td>
							</tr>
						</table>
						<input type="submit" value="Send">
					</form>
				
			</div>
		</div>
<?php include("inc/footer.php"); ?>

