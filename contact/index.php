<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name    = stripslashes(trim($_POST['name']));
	$email   = stripslashes(trim($_POST['email']));
	$phone   = stripslashes(trim($_POST['phone']));
	$message = stripslashes(trim($_POST['message']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';

    if (preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $subject)) {
        die("Header injection detected");
    }

	$to = 'contact@vasilopoulouvicky.gr';

	$subject = "Μήνυμα από {$name}";
	
	$body = "
	<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
	<html>
		<head>
			<meta charset=\"utf-8\">
		</head>
		<body>
			<p><strong>Ονοματεπώνυμο:</strong> {$name}</p>
			<p><strong>Email:</strong> {$email}</p>
			<p><strong>Τηλέφωνο:</strong> {$phone}</p>
			<p><strong>Μήνυμα:</strong> {$message}</p>
		</body>
	</html>";
	
	// To send HTML mail, the Content-type header must be set
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=iso-8859-1';
	
	// Additional headers
	$headers[] = 'To: contact@vasilopoulouvicky.gr';
	$headers[] = 'From: contact@vasilopoulouvicky.gr';
	
	// send mail
	mail($to, $subject, $body, implode("\r\n", $headers));

	echo 'Success';
?>