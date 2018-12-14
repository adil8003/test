<?php

require $_SERVER['DOCUMENT_ROOT']."/ajax/class.mail.php";

$return = array();
$return['status'] = 'fail';
$return['msg'] = 'Oops. Something went happend. Please try again.';
$toEmail = 'anant@aemigiance.com'; // support@bricapp.com


$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$file = isset($_POST['file']) ? $_POST['file'] : '';
$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
$position = isset($_POST['position']) ? $_POST['position'] : '';
$file_path = "http://www.aemigiance.com/upload/resumes/".$file;

	
$body = 'Resume: '.$name.' </br>';
$body = '<hr></hr>';
$body .= 'Name: <b>'.$name.'</b> </br>';
$body .= 'Email ID: <b>'.$email.'</b> </br>';
$body .= 'Mobile: <b>'.$mobile.'</b> </br>';
$body .= 'Position: <b>'.$position.'</b> </br>';
$body .= 'Resume: <b><a href="'.$file_path.'" target="_blank" >'.$file.'</a></b> </br>';


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
$arrEmail['subject'] = 'Resume: For the post of '.$position;
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