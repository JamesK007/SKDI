<?php

switch($_REQUEST['cemail']) {
	default: 
// replace the bellow email with your email id
$sendto = 'info@siestakeydecor.com';  break;	
}

$subject = 'Contact from contact form';
$errormessage = 'Oops! There seems to have been a problem. May be these...';
$thanks = "Thanks for contacting us! We'll get back to you as soon as possible!";
$emptyname =  'Enter your name?';
$emptyemail = 'Enter your email address?';
$emptytele = 'Enter your telephone number?';
$emptymessage = 'Enter a message?';
$alertname =  'Enter your name using only the standard alphabet?';
$alertemail = 'Enter your email in this format: <i>name@example.com</i>?';
$alerttele = 'Enter your telephone number in this format: <i>xxx-xxx-xxxx</i>?';
$alertmessage = "Making sure you aren't using any parenthesis or other escaping characters in the message? Most URLS are fine though!";

$alert = '';
$pass = 0;

function clean_var($variable) {
    $variable = strip_tags(stripslashes(trim(rtrim($variable))));
  return $variable;
}

if ( empty($_REQUEST['cname']) ) {
	$pass = 1;
	$alert .= "<li>" . $emptyname . "</li>";
} elseif ( ereg( "[][{}()*+?.\\^$|]", $_REQUEST['cname'] ) ) {
	$pass = 1;
	$alert .= "<li>" . $alertname . "</li>";
}
if ( empty($_REQUEST['cemail']) ) {
	$pass = 1;
	$alert .= "<li>" . $emptyemail . "</li>";
} elseif ( !eregi("^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$", $_REQUEST['cemail']) ) {
	$pass = 1;
	$alert .= "<li>" . $alertemail . "</li>";
}
if ( empty($_REQUEST['cphone']) ) {
	$pass = 1;
	$alert .= "<li>" . $emptytele . "</li>";
} elseif ( !ereg( "\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}", $_REQUEST['cphone'] ) ) {
	$pass = 1;
	$alert .= "<li>" . $alerttele . "</li>";
}
if ( empty($_REQUEST['cmessage']) ) {
	$pass = 1;
	$alert .= "<li>" . $emptymessage . "</li>";
} elseif ( ereg( "[][{}()*+?\\^$|]", $_REQUEST['cmessage'] ) ) {
	$pass = 1;
	$alert .= "<li>" . $alertmessage . "</li>";
}

	if ( $pass==1 ) {

	echo "<script>$(\".message\").hide(\"slow\").show(\"slow\"); </script>";
	echo "<b>" . $errormessage . "</b>";
	echo "<ul>";
	echo $alert;
	echo "</ul>";

	} elseif (isset($_REQUEST['cmessage'])) {

	    $message = "From: " . clean_var($_REQUEST['cname']) . "\n";
		$message .= "Email: " . clean_var($_REQUEST['cemail']) . "\n";
	    $message .= "Telephone: " . clean_var($_REQUEST['cphone']) . "\n";
		 $message .= "Website: " . clean_var($_REQUEST['cwebsite']) . "\n";
	    $message .= "Message: \n" . clean_var($_REQUEST['cmessage']);
	    $header = 'From:'. clean_var($_REQUEST['cemail']);

		mail($sendto, $subject, $message, $header);

		echo "<script>$(\".message\").hide(\"slow\").show(\"slow\").animate({opacity: 1.0}, 4000).hide(\"slow\"); $(':input').clearForm() </script>";
		echo $thanks;
		die();
		echo "<br/><br/>" . $message;

	}
	

?>
