<?php

require $_SERVER['DOCUMENT_ROOT']."/ajax/class.mail.php";

$return = array();
$return['status'] = 'fail';
$return['msg'] = 'Oops. Something went happend. Please try again.';
$toEmail = 'anant@aemigiance.com'; // support@bricapp.com


$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';

	
$body = 'Contact Us: Message  </br>';
$body = '<hr></hr>';
$body .= 'Name: "<b>'.$name.'</b>" </br>';
$body .= 'Email ID: "<b>'.$email.'</b>" </br>';
$body .= 'Mobile: "<b>'.$mobile.'</b>" </br>';
$body .= 'Message: "<b>'.$message.'</b>" </br>';


// to subscriber
$arrEmail = array();
$arrEmail['email'] = $email;
$arrEmail['name'] =  $name;
$arrEmail['subject'] = 'Thank you for contacting Aemigiance. We will get back to you soon.';
$arrEmail['body'] = $body;
$arrEmail['message'] = $body;

$mail = new mail();
$ret = $mail->sendEmail($arrEmail);

// to admin
$arrEmail = array();
$arrEmail['email'] = $toEmail;
$arrEmail['name'] =  'Anant: Aemigiance';
$arrEmail['subject'] = 'Contact: Aemigiance';
$arrEmail['body'] = $body;
$arrEmail['message'] = $body;

$ret1 = $mail->sendEmail($arrEmail);

if($ret){
	$return['status'] = 'success';
	$return['msg'] = 'Welcome. Thank you for subscribing with us';
}
	

 echo json_encode($return);
 die;
?>