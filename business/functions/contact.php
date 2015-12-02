<?php
	
	
	//include site-wide depencendies
	include "../../data/dependencies.php";
	//extract cleaned passed values
	extract($cleanpost);
	//create message content
	$msg = '<h1>Thrender Message</h1><br /><h2>From customer: '.$customerid.', email: '.$email.'</h2><br /><h3>Subject: '.$subject.'</h3><br /><h4>'.strip_tags($message).'</h4>';
	//declare headers for email validation and spam prevention
	$headers = 'From: server@cenode.com' . "\r\n" .
   'Reply-To: ' . $email . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
// send email
mail("bmiller100@my.devry.edu","Threndr Message",$msg,$headers);
	//redirect to home page
	header("Location: /home");
	exit();
	
	?>