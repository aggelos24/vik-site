<?php
include 'simpleMail.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name    = stripslashes(trim($_POST['name']));
	$email   = stripslashes(trim($_POST['email']));
	$phone   = stripslashes(trim($_POST['phone']));
	$message = stripslashes(trim($_POST['message']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';

    if (preg_match($pattern, $name) || preg_match($pattern, $email)) {
        die("Header injection detected");
    }

	$to = 'contact@vasilopoulouvicky.gr';

	$mail = new SimpleMail();

	$mail->setTo('contact@vasilopoulouvicky.gr');
	$mail->setFrom('contact@vasilopoulouvicky.gr');
	$mail->setSender($name);
	$mail->setSenderEmail($email);
	$mail->setSubject("Μήνυμα από {$name}");

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

	$mail->setHtml($body);
	$mail->send();

	echo 'Success';
}
?>