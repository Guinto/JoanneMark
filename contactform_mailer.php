<?php

// Your E-Mail-Address
$receiver    = "jnnmark@gmail.com";

// Message shown when form gets submitted successfully
$success_msg = "The message was sent successfully.";

// Message shown when an input-error occurs
$error_msg   = "Please fill in all fields correctly.";


// If the form is submitted
if(isset($_POST['submit'])) {

	// Check to make sure that the name field is not empty
	if(trim($_POST['name']) == '') {
		$has_error = true;
	}
	else {
		$name = trim($_POST['name']);
	}

	// Check to make sure that the subject field is not empty
	if(trim($_POST['subject']) == '') {
		$has_error = true;
	} 
	else {
		$subject = trim($_POST['subject']);
	}

	// Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$has_error = true;
	} 
	else if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/i", trim($_POST['email']))) {
		$has_error = true;
	} 
	else {
		$email = trim($_POST['email']);
	}

	// Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$has_error = true;
	} 
	else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['message']));
		} 
		else {
			$message = trim($_POST['message']);
		}
	}

	// If there is no error, send the email
	if(!isset($has_error)) {
		$headers = "From: $name <customer@jnnmark.com>\n";
  	$headers.= "Content-Type: text/plain; charset=\"UTF-8\"\n";
    $message.= "From: $email";
		$message.= "\n\n---\nThis E-Mail was sent through your website's contact form.";

		mail($receiver, $subject, $message, $headers);
		echo "<p class='success'>".$success_msg."</p>";
	} 
	else {
		echo "<p class='error'>".$error_msg."</p>";
	}
}
?>