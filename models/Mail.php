<?php

namespace app\models;

use Yii;

//class Videopath extends \yii\db\ActiveRecord
class mail {

    public function sendEmail($arrMailDetails) {
        $email = 'asauravsuman@gmail.com';
        $date = date('d/m/Y');
        $to = $arrMailDetails['toemail'];
        $subject = $arrMailDetails['subject'];
        $body = $this->getEmailHeader();
        $body .= $arrMailDetails['body'];
        $body .= $this->getEmailFooter();
        $header = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'From:Kiwings <asauravsuman@gmail.com>' . "\r\n" .
                'Content-type: text/html' . "\r\n" .
                'Reply-To: sadil8003@gmail.com' . "\r\n" .
//                     'CC: asauravsuman@gmail.com ' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        $mail = mail($to, $subject, $body, $header);
        if ($mail) {
            $arrReturn['status'] = TRUE;
        } else {
            $arrReturn['status'] = FALSE;
        }
    }

    public function getCSS() {
        $strCSS = "    html {font-family: sans-serif;font-size: 62.5%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;
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
            /* Customize container */@media (min-width: 768px) {.container {max-width: 98%;}}
            /* Main marketing message and sign up button */.jumbotron {text-align: center;border-bottom: 1px solid #e5e5e5;}
            .jumbotron .btn {font-size: 21px;padding: 14px 24px;}/* Responsive: Portrait tablets and up */@media screen and (min-width: 768px) {/* Remove the padding we set earlier */
            .header,.marketing,.footer {padding-left: 0;padding-right: 0;}/* Space out the masthead */.header {background: #000000;border-bottom: 1px solid #468cc8;border-top: 1px solid #468cc8;
            border-left: 1px solid #bbbbbb;padding: 6px 20px;border-top-left-radius: 8px;border-top-right-radius: 8px; }}
            .nullTopCorner {border-top-left-radius : 0px;border-top-right-radius : 0px}.headSetFont {color: #000000;font-size: 24px;text-align : center;font-family : Open Sans, arial !important;}
            .setPOne {color: #323232;font-size: 16px;text-align    : left;font-family : Open Sans, arial;}
            .setPFooter {font-size: 11px;color: #323232;text-align: center;}.setPFooter span ,.comName{color : #468cc8;}.fontBold{font-weight: bold;}
        ";
        return $strCSS;
    }

    public function getEmailHeader() {
        $logoURL = 'http://kiwings.com/images/kwings.png';
        $headURL = 'http://kiwings.com';
        $header = " Kiwings ";
        $emailCss = $this->getCSS();
        $headHtml = "<!DOCTYPE html>
                <html lang='en'>
                <head>
                        <title>" . $header . "</title>
                </head>
                <style>" . $emailCss . "</style>
                    <body>
                        <div class='container header' style='max-width: 98%;   line-height: 2.1428571435;
                        color: inherit;
                        background-color: #FFFFFF;
                        border: 1px solid #468CC8;  
                        border-bottom: 1px solid #468cc8;
                        border-top: 1px solid #468cc8;
                        border-left: 1px solid #bbbbbb;
                        padding: 6px 20px;
                        border-top-left-radius: 8px;
                        border-top-right-radius: 8px;'>
                            <div style= 'background-color : #afaaff' class='header' >
                                <a href= '" . $headURL . "'><img width='30%' border='0' title='" . $header . "g' alt='" . $header . "' src='" . $logoURL . "'></a>
                            </div>";
        return $headHtml;
    }

    public function getEmailFooter() {
        $comURL = 'http://kiwings.com/';
        $companyName = 'Kiwings ';
        $companyUrl = 'http://kiwings.com/';
        $comName = 'Kiwings';
        $email = 'asauravsuman@gmail.com';
        $footer = "<div style= 'background-color : #FFE4AA' class='header nullTopCorner' >
                        </div>
                        <div class='footer' >
                         <p  class= 'setPOne' style= 'font-size : 13.5px;color: #999;font-style: oblique;font-family: serif;'>
                                    You are receiving this email because your email address was used to register at <a href= '" . $comURL . "' class= 'comName'>" . $comName . "</a>.If you have received this email in error please disregard or contact <span class= 'comName'>" . $email . "</span>.
                                                </p>
                            <p class= 'setPFooter' style= 'font-size : 13.5px;color: #999;font-style: oblique;font-family: serif;'>
                                Keep <span>contact@kiwings.com</span> in your contacts. <a href= '" . $companyUrl . "' class= 'comName'>" . $companyName . "</a>
                            </p>
                        </div>
                        </div>
                    </body>
                </html>";
        return $footer;
    }

}
