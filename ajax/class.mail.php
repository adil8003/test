<?php
date_default_timezone_set('Etc/UTC');

require $_SERVER['DOCUMENT_ROOT'].'/phpmailer/PHPMailerAutoload.php';


class mail{

function sendEmail($arrDetails){
$header = 'ImgApti';
$headURL = 'http://mcctv.in';
$email = 'anant@aemigiance.com';
//$logoURL ='http://www.aemigiance.com/logo/aemigiance.png';
$comName = 'Aemigiance';
$comURL = 'http://mcctv.in/';
$subject = $arrDetails['subject'];

$emailCss = "    html {font-family: sans-serif;font-size: 62.5%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);}body {margin: 0;font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 14px;
            line-height: 1.428571429;color: #333333;background-color: #ffffff;padding-top: 20px;padding-bottom: 20px;
            background-color : #F6F6F6;}a {color: #428bca;text-decoration: none;}img {vertical-align: middle;}
            p {margin: 0 0 10px;}.container {padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;}
            .btn {display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: normal;line-height: 1.428571429;
            text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer;background-image: none;
            border: 1px solid transparent;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;
            user-select: none;}.btn-success {color: #ffffff;background-color: #FF9900;border-color: #FF9900;}
            .jumbotron {padding: 30px;font-size: 21px;font-weight: 200;line-height: 2.1428571435;color: inherit;
            background-color: #FFFFFF;border: 1px solid #468CC8;}.jumbotron p {line-height: 1.4;}@media screen and (min-width: 768px) {
            .jumbotron {padding-top: 48px;padding-bottom: 48px;}.container .jumbotron {padding-right: 20px;padding-left: 20px;
            }}/***//* Custom page header */.header {border-bottom: 1px solid #e5e5e5;background: #000000;border-bottom    : 1px solid #468cc8;border-top        : 1px solid #468cc8;
            border-left: 1px solid #bbbbbb; padding: 6px 20px;border-top-left-radius: 8px;border-top-right-radius: 8px;}
            /* Custom page footer */.footer {padding-top: 19px;color: #777;border-top: 1px solid #e5e5e5;}
            /* Customize container */@media (min-width: 768px) {.container {max-width: 99%;}}
            /* Main marketing message and sign up button */.jumbotron {text-align: center;border-bottom: 1px solid #e5e5e5;}
            .jumbotron .btn {font-size: 21px;padding: 14px 24px;}/* Responsive: Portrait tablets and up */@media screen and (min-width: 768px) {/* Remove the padding we set earlier */
            .header,.marketing,.footer {padding-left: 0;padding-right: 0;}/* Space out the masthead */.header {background: #000000;border-bottom: 1px solid #468cc8;border-top: 1px solid #468cc8;
            border-left: 1px solid #bbbbbb;padding: 6px 20px;border-top-left-radius: 8px;border-top-right-radius: 8px; }}
            .nullTopCorner {border-top-left-radius : 0px;border-top-right-radius : 0px}.headSetFont {color: #000000;font-size: 24px;text-align : center;font-family : Open Sans, arial !important;}
            .setPOne {color: #323232;font-size: 16px;text-align    : left;font-family : Open Sans, arial;}
            .setPFooter {font-size: 11px;color: #323232;text-align: center;}.setPFooter span ,.comName{color : #468cc8;}
        ";
$body = "    <!DOCTYPE html>
                <html lang='en'>
                <head>
                        <title>".$header."</title>
                </head>
                <style>".$emailCss."</style>
                    <body>
                        <div class='container' >
                            <div style= 'background-color : #FFE4AA' class='header' >
                                <a href= '".$headURL."'><img width='30%' border='0' title='".$header."g' alt='".$header."' src='".$logoURL."'></a>
                            </div>
                            <div class='jumbotron'>
                                <p  class= 'headSetFont'>Welcome to ".$header.".<br><br></p>
                                <p  class= 'setPOne'>Hi ".$arrDetails['name'].",<br></p>
                                <p  class= 'setPOne'>".$subject."<br></p>
                                <p  class= 'setPOne'>".$arrDetails['body']."<br></p>
                                <p  class= 'setPOne'>Thank you. <br></p>
                                <p  class= 'setPOne'>Please feel free to contact us for any queries: <br></p>
                <p class= 'setPOne'>Email - ".$email." <br>
                    Contact -  <br>
                </p>
                                <p  class= 'setPOne' style= 'font-size : 13.5px'>
                                    You are receiving this email because your email address was used to register at <a href= '".$comURL."' class= 'comName'>".$comName."</a>.If you have received this email in error please disregard or contact <span class= 'comName'>".$email."</span>.
                                                </p>
                                                </div>
                            <div style= 'background-color : #FFE4AA' class='header nullTopCorner' >
                            </div>
                            <div class='footer' >
                                <p class= 'setPFooter' >
                                    Keep <span>".$email."</span> in your contacts. &copy; 2015 ".$comName.". &reg; All Rights Reserved
                                </p>
                            </div>
                        </div>
                            </body>
                        </html>
                    ";






       
		
		
		
$result = 0;
//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "mail.aemigiance.com" ; //******"mail.sancsvision.com";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "anant@aemigiance.com" ; //*****"customercare@sancsvision.com";
//Password to use for SMTP authentication
$mail->Password = "pwd@Anant";
//Set who the message is to be sent from
$mail->setFrom('anant@aemigiance.com', 'Anant: Aemigiance');
//Set an alternative reply-to address
$mail->addReplyTo('anant@aemigiance.com', 'Anant: Aemigiance');
//Set who the message is to be sent to
$mail->addAddress($arrDetails['email'], $arrDetails['name']);
//Set the subject line
$mail->Subject = $arrDetails['subject'];
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($body);
//Replace the plain text body with one created manually
$mail->AltBody = $body;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

	//send the message, check for errors
	if (!$mail->send()) {
		$result = $mail->ErrorInfo;
	} else {
		$result = 1;
	}
	return $result;
}
// end of class
}
?>

