<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Resproject;
use app\models\Resproperty;
use app\models\Comproject;
use app\models\Comproperty;
use app\models\Builder;
use app\models\Customer;
use app\models\User;
use app\models\Resprojectproperty;
use app\models\Resprojectproject;
use app\models\Resprojectimage;
use app\models\Resprojectamaneties;
use app\models\Resprojectgeolocation;
use app\models\Resprojectcost;
use app\models\Respropertyamaneties;
use app\models\Respropertygeolocation;
use app\models\Respropertyimage;
use app\models\Respropertycost;
use app\models\Respropertytype;
use app\models\Respropertyproject;
use app\models\Comprojectamaneties;
use app\models\Comprojectgeolocation;
use app\models\Comprojectproject;
use app\models\Comprojectoffice;
use app\models\Comprojectimage;
use app\models\Financial;
use app\models\Financialbigcontent;
use app\models\Websitecontent;
use app\models\Resprojctfeedback;
use app\models\Respropertyfeedback;
use app\models\Comprojectfeedback;
use app\models\Resprojctfeedbacklog;
use app\models\Blog;
use app\models\Status;
use app\models\Contactus;
use yii\data\Pagination;
use app\models\Generalfeedback;
use app\models\Resprojectmicrositedetails;
use app\models\Resaleproperty;
use app\models\Resalepropertyimage;
use app\models\Comprojectdetails;
use app\models\Resalemicrositedetails;
use app\models\Comprojectmicrositedetails;
use app\models\Followup;
use app\models\Comprojectcost;
use app\models\Resalefeedback;
use app\models\Searchproperty;
use app\models\Mail;
use app\models\Postproperty;

class ApiController extends Controller {

    public $enableCsrfValidation = false;
    public $user_id = '';

    public function init() {
        $this->layout = "";
    }

    public function behaviors() {
        return array_merge(parent::behaviors(), [
            // For cross-domain AJAX request
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    // restrict access to domains:
                    'Access-Control-Allow-Origin' => '*', // Cache (seconds)
                ],
            ],
        ]);
    }

    public function actionIndex($callback = null) {
// retrieve data to be returned
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionSendmailbyresid($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
//        $name = $request->post('name');
//        $phone = $request->post('phone');
//        $email = $request->post('email');
//        $description = $request->post('description');
//        $resprojectname = $request->post('resprojectname');
//        $resprojectid = $request->post('resprojectid');
        $date = date('Y-m-d');
        $header = 'Customer enquiry details ' . $date;
        $logo = 'http://uniquepaf.com/images/logo.png';
        $comURL = 'http://uniquepaf.com/';
        $companyemail = 'sadil8003@gmail.com';
        $subject = 'Customer enquiry details' . $request->post('resprojectname');
        $body = "<div class='jumbotron'>
                    <p  class= 'headSetFont'>.<br></p>
                    <p  class= 'setPOne fontBold'><b>Customer name</b> " . $request->post('name') . ",<br></p>
                    <p  class= 'setPOne fontBold'><b>Mobile no.:</b> " . $request->post('phone') . "<br></p>
                    <p  class= 'setPOne fontBold'><b>Email id:</b> " . $request->post('email') . "<br></p>
                    <p  class= 'setPOne fontBold'><b>Property ID: </b> " . $request->post('resprojectid') . "<br></p>
                    <p  class= 'setPOne fontBold'><b>Thank you.</b> <br></p>
                        Contact -  <br>
                    </p>
                </div>";

        $arrMailDetails = Array();
        $arrMailDetails['subject'] = $subject;
        $arrMailDetails['toemail'] = $companyemail;
        $arrMailDetails['from'] = $request->post('email');
        $arrMailDetails['body'] = $body;
        $objMail = new Mail();
        $objMail->sendEmail($arrMailDetails);
        ////////////////////////////////////////////
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionSavepostproperty($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $objPostproperty = new Postproperty();
        $objPostproperty->ownerid = $request->get('ownerid');
        $objPostproperty->agentid = $request->get('agentid');
        $objPostproperty->builderid = $request->get('builderid');
        $objPostproperty->rentid = $request->get('rentid');
        $objPostproperty->saleid = $request->get('saleid');
        $objPostproperty->contact = $request->get('contact');
        $objPostproperty->email = $request->get('email');
        $objPostproperty->location = $request->get('location');
        $objPostproperty->totalarea = $request->get('totalarea');
        $objPostproperty->expectedprice = $request->get('expectedprice');
        if ($objPostproperty->save()) {
            $arrReturn['status'] = TRUE;
            $arrReturn['id'] = $objPostproperty->id;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionSaverespropertyfeedback($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $objRespropertyfeedback = new Respropertyfeedback();
        $objRespropertyfeedback->respropertyid = $request->get('respropertyid');
        $objRespropertyfeedback->name = $request->get('name');
        $objRespropertyfeedback->phone = $request->get('phone');
        $objRespropertyfeedback->email = $request->get('email');
        $objRespropertyfeedback->description = $request->get('description');
        $objRespropertyfeedback->status = 'Active';
        if ($objRespropertyfeedback->save()) {
            $arrReturn['status'] = TRUE;
            $arrReturn['id'] = $objRespropertyfeedback->id;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetmicrositedetails($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $status = 'Active';
        $resprojectid = $request->get('id');

        $arrTemp = array();
        $arrTemp['property'] = Resproject::find()->where(['id' => $resprojectid])->one();

        $arrTemp['microsite'] = Resprojectmicrositedetails::find()->where(['id' => $arrTemp['property']['resprojectmicrositedetailsid']])->one();

        $arrTemp['project'] = Resprojectproject::find()->where(['id' => $arrTemp['property']->resprojectprojectid])->one();
        $arrTemp['builder'] = Builder::find()->where(['id' => $arrTemp['property']->builderid])->one();
        $arrTemp['amaneties'] = Resprojectamaneties::find()->where(['id' => $arrTemp['property']->resprojectprojectid])->one();
        $arrTemp['cost'] = Resprojectcost::find()->where(['id' => $arrTemp['property']->resprojectprojectid])->one();
        $arrTemp['resproperty'] = Resprojectproperty::find()->where(['id' => $arrTemp['property']->resprojectpropertyid])->one();
        $arrTemp['location'] = Resprojectcost::find()->where(['id' => $arrTemp['property']->resprojectgeolocationid])->one();


        $arrTemp['resprojectimage'] = Resprojectimage::find()->where(['resprojectid' => $resprojectid])->all();
        if (!$arrTemp['resprojectimage']) {
            $arrTemp1 = array();
            $arrTemp1['path'] = '/resources/resproject/no-thumb.jpg';
            $arrTemp['resprojectimage'][] = $arrTemp1;
        }

        if ($arrTemp) {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $arrTemp;
        }

        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetresalemicrositedetails($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $status = 'Active';
        $resalepropertyid = $request->get('id');
        $arrTemp = array();
        $arrTemp['property'] = Resaleproperty::find()->where(['id' => $resalepropertyid])->one();
        $arrTemp['microsite'] = Resalemicrositedetails::find()->where(['id' => $arrTemp['property']['resalemicrositedetailsid']])->one();
        $arrTemp['resalepropertyimage'] = Resalepropertyimage::find()->where(['resalepropertyid' => $resalepropertyid])->all();
        if (!$arrTemp['resalepropertyimage']) {
            $arrTemp1 = array();
            $arrTemp1['path'] = '/resources/resproject/no-thumb.jpg';
            $arrTemp['resalepropertyimage'][] = $arrTemp1;
        }

        if ($arrTemp) {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $arrTemp;
        }

        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

////////////////////Commercial Microsite////////////////////////
    public function actionGetcommicrositedetails($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $status = 'Active';
        $comprojectid = $request->get('id');

        $arrTemp = array();
        $arrTemp['property'] = Comproject::find()->where(['id' => $comprojectid])->one();
        $arrTemp['microsite'] = Comprojectmicrositedetails::find()->where(['id' => $arrTemp['property']['comprojectmicrositedetailsid']])->one();
        $arrTemp['project'] = Comprojectproject::find()->where(['id' => $arrTemp['property']->comprojectprojectid])->one();
        $arrTemp['builder'] = Builder::find()->where(['id' => $arrTemp['property']->builderid])->one();
        $arrTemp['amaneties'] = Comprojectamaneties::find()->where(['id' => $arrTemp['property']->comprojectprojectid])->one();
        $arrTemp['resproperty'] = Comprojectproject::find()->where(['id' => $arrTemp['property']->comprojectprojectid])->one();
        $arrTemp['cost'] = Comprojectcost::find()->where(['id' => $arrTemp['property']->comprojectcostid])->one();
        $arrTemp['comprojectimage'] = Comprojectimage::find()->where(['comprojectid' => $comprojectid])->all();
        if (!$arrTemp['comprojectimage']) {
            $arrTemp1 = array();
            $arrTemp1['path'] = '/resources/resproject/no-thumb.jpg';
            $arrTemp['comprojectimage'][] = $arrTemp1;
        }

        if ($arrTemp) {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $arrTemp;
        }

        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionSavegeneralfeedback($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $objGeneralfeedback = new Generalfeedback();
        $objGeneralfeedback->name = $request->get('name');
        $objGeneralfeedback->phone = $request->get('phone');
        $objGeneralfeedback->email = $request->get('email');
        $objGeneralfeedback->description = $request->get('description');
        $objGeneralfeedback->status = 'Active';
        if ($objGeneralfeedback->save()) {
            $arrReturn['id'] = $objGeneralfeedback->id;
            //////////////////////MAiL fUNCTION////////////////////////////////

            $date = date('Y-m-d');
            $name = $objGeneralfeedback->name;
            $email = $objGeneralfeedback->email;
            $phone = $objGeneralfeedback->phone;
            $message = $objGeneralfeedback->description;
            $abhishek_sir = "abhishekk@uniquepaf.com";
            $kadam_sir = "ckadam@uniquepaf.com";
            $umesh_sir = "umeshs@uniquepaf.com";
            $uniquepaf = "contact@uniquepaf.com";
            $str = "";
            $str .= "<table border=2>";
            $str .= "<tr><td>Name</td><td>$name</td></tr>";
            $str .= "<tr><td>Email</td><td>$email</td></tr>";
            $str .= "<tr><td>Phone</td><td>$phone</td></tr>";
            $str .= "<tr><td>Message</td><td>$message</td></tr>";
            $str .= "</table>";
            //begin of HTML message 
            $message = "
            <html> 
              <body> 
                    " . $str . "
              </body>
            </html>";

            $to = "abhishekk@uniquepaf.com";
            $from = "contact@uniquepaf.com";
            $subject = "We Have Recieved A Feedback From A Customer[$name] on [$date]";
            $header = 'MIME-Version: 1.0' . "\r\n";
            $header = 'From: contact@uniquepaf.com' . "\r\n" .
                    'Content-type: text/html' . "\r\n" .
                    'Reply-To: contact@uniquepaf.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            $mail = mail($to, $subject, $message, $header);

            if ($mail) {
                $arrReturn['status'] = TRUE;
            } else {
                $arrReturn['status'] = FALSE;
            }

            ////////////////////////////////////////////
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionSaveresprojectfeedback($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $objResprojctfeedback = new Resprojctfeedback();
        $objResprojctfeedback->resprojectid = $request->get('resprojectid');
        $objResprojctfeedback->name = $request->get('name');
        $objResprojctfeedback->phone = $request->get('phone');
        $objResprojctfeedback->email = $request->get('email');
        $objResprojctfeedback->description = $request->get('description');
        $objResprojctfeedback->status = 'Active';
        if ($objResprojctfeedback->save()) {
            $arrReturn['id'] = $objResprojctfeedback->id;
            //////////////////////MAiL fUNCTION////////////////////////////////
            $date = date('Y-m-d');
            $name = $objResprojctfeedback->name;
            $email = $objResprojctfeedback->email;
            $phone = $objResprojctfeedback->phone;
            $message = $objResprojctfeedback->description;
            $projectname = $request->get('projectname');
            $abhishek_sir = "abhishekk@uniquepaf.com";
//              $kadam_sir = "ckadam@uniquepaf.com";
//              $umesh_sir = "umeshs@uniquepaf.com";
            $uniquepaf = "abhishekk@uniquepaf.com";
            $str = "";
            $str .= "<table>";
            $str .= "<tr><td>Project</td><td>$projectname</td></tr>";
            $str .= "<tr><td>Name</td><td>$name</td></tr>";
            $str .= "<tr><td>Email</td><td>$email</td></tr>";
            $str .= "<tr><td>Phone</td><td>$phone</td></tr>";
            $str .= "<tr><td>Message</td><td>$message</td></tr>";
            $str .= "</table>";
            //begin of HTML message 
            $message = "
            <html> 
              <body> 
                    " . $str . "
              </body>
            </html>";

            $to = "abhishekk@uniquepaf.com";
            $from = "contact@uniquepaf.com";
            $subject = "Feedback Customer[$name] on [$date] For $projectname ";
            $header = 'MIME-Version: 1.0' . "\r\n";
            $header = 'From: contact@uniquepaf.com' . "\r\n" .
                    'Content-type: text/html' . "\r\n" .
                    'Reply-To: contact@uniquepaf.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            $mail = mail($to, $subject, $message, $header);

            if ($mail) {
                $arrReturn['status'] = TRUE;
            } else {
                $arrReturn['status'] = FALSE;
            }

            ////////////////////////////////////////////
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionSaveresalefeedback($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $objResalefeedback = new Resalefeedback();
        $objResalefeedback->resalepropertyid = $request->get('resalepropertyid');
        $objResalefeedback->name = $request->get('name');
        $objResalefeedback->phone = $request->get('phone');
        $objResalefeedback->email = $request->get('email');
        $objResalefeedback->description = $request->get('description');
        $objResalefeedback->status = 'Active';
        if ($objResalefeedback->save()) {
            $arrReturn['id'] = $objResalefeedback->id;
            //////////////////////MAiL fUNCTION////////////////////////////////
            $date = date('Y-m-d');
            $name = $objResalefeedback->name;
            $email = $objResalefeedback->email;
            $phone = $objResalefeedback->phone;
            $message = $objResalefeedback->description;
            $projectname = $request->get('projectname');
            $abhishek_sir = "abhishekk@uniquepaf.com";
//              $kadam_sir = "ckadam@uniquepaf.com";
//              $umesh_sir = "umeshs@uniquepaf.com";
            $uniquepaf = "abhishekk@uniquepaf.com";
            $str = "";
            $str .= "<table>";
            $str .= "<tr><td>Project</td><td>$projectname</td></tr>";
            $str .= "<tr><td>Name</td><td>$name</td></tr>";
            $str .= "<tr><td>Email</td><td>$email</td></tr>";
            $str .= "<tr><td>Phone</td><td>$phone</td></tr>";
            $str .= "<tr><td>Message</td><td>$message</td></tr>";
            $str .= "</table>";
            //begin of HTML message 
            $message = "
            <html> 
              <body> 
                    " . $str . "
              </body>
            </html>";

            $to = "abhishekk@uniquepaf.com";
            $from = "contact@uniquepaf.com";
            $subject = "Feedback Customer[$name] on [$date] For $projectname ";
            $header = 'MIME-Version: 1.0' . "\r\n";
            $header = 'From: contact@uniquepaf.com' . "\r\n" .
                    'Content-type: text/html' . "\r\n" .
                    'Reply-To: contact@uniquepaf.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            $mail = mail($to, $subject, $message, $header);

            if ($mail) {
                $arrReturn['status'] = TRUE;
            } else {
                $arrReturn['status'] = FALSE;
            }

            ////////////////////////////////////////////
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionSavecomprojectfeedback($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $objComprojectfeedback = new Comprojectfeedback();
        $objComprojectfeedback->comprojectid = $request->get('comprojectid');
        $objComprojectfeedback->name = $request->get('name');
        $objComprojectfeedback->phone = $request->get('phone');
        $objComprojectfeedback->email = $request->get('email');
        $objComprojectfeedback->description = $request->get('description');
        $objComprojectfeedback->status = 'Active';
        if ($objComprojectfeedback->save()) {
            $arrReturn['status'] = TRUE;
            $arrReturn['id'] = $objComprojectfeedback->id;
            //////////////////////MAiL fUNCTION////////////////////////////////
            $date = date('Y-m-d');
            $name = $objComprojectfeedback->name;
            $email = $objComprojectfeedback->email;
            $phone = $objComprojectfeedback->phone;
            $message = $objComprojectfeedback->description;
            $projectname = $request->get('projectname');
            $abhishek_sir = "abhishekk@uniquepaf.com";
            $uniquepaf = "abhishekk@uniquepaf.com";
            $str = "";
            $str .= "<table>";
            $str .= "<tr><td>Project</td><td>$projectname</td></tr>";
            $str .= "<tr><td>Name</td><td>$name</td></tr>";
            $str .= "<tr><td>Email</td><td>$email</td></tr>";
            $str .= "<tr><td>Phone</td><td>$phone</td></tr>";
            $str .= "<tr><td>Message</td><td>$message</td></tr>";
            $str .= "</table>";
            //begin of HTML message 
            $message = "
            <html> 
              <body> 
                    " . $str . "
              </body>
            </html>";

            $to = "abhishekk@uniquepaf.com";
            $from = "contact@uniquepaf.com";
            $subject = "Feedback Customer[$name] on [$date] For $projectname ";
            $header = 'MIME-Version: 1.0' . "\r\n";
            $header = 'From: contact@uniquepaf.com' . "\r\n" .
                    'Content-type: text/html' . "\r\n" .
                    'Reply-To: contact@uniquepaf.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            $mail = mail($to, $subject, $message, $header);

            if ($mail) {
                $arrReturn['status'] = TRUE;
            } else {
                $arrReturn['status'] = FALSE;
            }

            ////////////////////////////////////////////
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetbuilder($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objData = Builder::find()->all();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objData;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetfinancial($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $objData = Financial::find()->all();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objData;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetfinancialbigcontent($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $objData = Financialbigcontent::find()->all();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objData;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetwebsitecontent($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $objData = Websitecontent::find()->all();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objData;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetallblog($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $status = 'publish';
        $request = Yii::$app->request;
        $objData = Blog:: find()->where(['status' => $status])->orderBy(['date' => SORT_DESC])->all();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objData;
        }
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetrespropertybyid($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objData = Resproperty::findOne($id);
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['property'] = $objData->toArray();
            $arrReturn['amaneties'] = $objData->respropertyamaneties->toArray();
            $arrReturn['project'] = $objData->respropertyproject->toArray();
            $arrReturn['cost'] = $objData->respropertycost->toArray();
            $arrReturn['builder'] = $objData->builder->toArray();
            $arrReturn['propertytype'] = $objData->respropertytype->toArray();
            $arrReturn['geolocation'] = $objData->respropertygeolocation->toArray();
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetcomprojectbyid($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objData = Comproject::findOne($id);
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['property'] = $objData->toArray();
            $arrReturn['amaneties'] = $objData->comprojectamaneties->toArray();
            $arrReturn['project'] = $objData->comprojectproject->toArray();
            $arrReturn['builder'] = $objData->builder->toArray();
            $arrReturn['office'] = $objData->comprojectoffice->toArray();
            $arrReturn['geolocation'] = $objData->comprojectgeolocation->toArray();
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetpropertyimagesbyid($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $respropertyid = $request->get('id');
        $objProjectimg = Respropertyimage::find()->where(['respropertyid' => $respropertyid])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['respropertyimage'] = $objProjectimg;
        if (!$arrReturn['respropertyimage']) {
            $arrReturn1 = array();
            $arrReturn1['path'] = '/resources/resproperty/no-thumb.jpg';
            $arrReturn['respropertyimage'][] = $arrReturn1;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionSavecontactus($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $objRespropertyfeedback = new Contactus();
        $objRespropertyfeedback->name = $request->get('name');
        $objRespropertyfeedback->phone = $request->get('phone');
        $objRespropertyfeedback->email = $request->get('email');
        $objRespropertyfeedback->subject = $request->get('subject');
        $objRespropertyfeedback->message = $request->get('message');
        if ($objRespropertyfeedback->save()) {
            $arrReturn['status'] = TRUE;
            $arrReturn['id'] = $objRespropertyfeedback->id;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetprojectimagesbyid($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $resprojectid = $request->get('id');
        $objProjectimg = Resprojectimage::find()->where(['resprojectid' => $resprojectid])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['resprojectimage'] = $objProjectimg;
        if (!$arrReturn['resprojectimage']) {
            $arrReturn1 = array();
            $arrReturn1['path'] = '/resources/resproject/no-thumb.jpg';
            $arrReturn['resprojectimage'][] = $arrReturn1;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetcomprojectimagesbyid($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $comprojectid = $request->get('id');
        $objComprojectimage = Comprojectimage::find()->where(['comprojectid' => $comprojectid])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['comprojectimage'] = $objComprojectimage;
        if (!$arrReturn['comprojectimage']) {
            $arrReturn1 = array();
            $arrReturn1['path'] = '/resources/comproject/no-thumb.jpg';
            $arrReturn['comprojectimage'][] = $arrReturn1;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetresprojectbyid($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objData = Resproject::find()->where(['id' => $id, 'status' => 'Active'])->one();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['property'] = $objData->toArray();
            $arrReturn['amaneties'] = $objData->resprojectamaneties->toArray();
            $arrReturn['project'] = $objData->resprojectproject->toArray();
            $arrReturn['cost'] = $objData->resprojectcost->toArray();
            $arrReturn['builder'] = $objData->builder->toArray();
            $arrReturn['propertytype'] = $objData->resprojectproperty->toArray();
            $arrReturn['geolocation'] = $objData->resprojectgeolocation->toArray();
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetresproject($callback = null) {
        $arrReturn = array();
        $request = Yii::$app->request;
        $status = 'Active';
        $objData = Resproject::find(['Active' => $status])->all();
        foreach ($objData as $key => $value) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['project'] = $value;
            $arrTemp['property'] = $value->resprojectproperty->toArray();
            $arrTemp['builder'] = $value->builder->toArray();
            $arrTemp['amaneties'] = $value->resprojectamaneties->toArray();
            $arrTemp['cost'] = $value->resprojectcost->toArray();
            $arrTemp['resprojectproject'] = $value->resprojectproject->toArray();
            $arrTemp['resprojectimage'] = Resprojectimage::find()->where(['resprojectid' => $value->id])->all();
            if (!$arrTemp['resprojectimage']) {
                $arrTemp1 = array();
                $arrTemp1['path'] = '/resources/resproject/no-thumb.jpg';
                $arrTemp['resprojectimage'][] = $arrTemp1;
            }
            $arrReturn['data'][] = $arrTemp;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetresproperty($callback = null) {
        $arrReturn = array();
        $request = Yii::$app->request;
        $status = 'Active';
        $objData = Resproperty::find(['Active' => $status])->all();
        foreach ($objData as $key => $value) {
            $arrTemp = array();
            $arrTemp['property'] = $value;
            $arrTemp['builder'] = $value->builder->toArray();
            $arrTemp['amaneties'] = $value->respropertyamaneties->toArray();
            $arrTemp['cost'] = $value->respropertycost->toArray();
            $arrTemp['respropertyimage'] = Respropertyimage::find()->where(['respropertyid' => $value->id])->all();
            if (!$arrTemp['respropertyimage']) {
                $arrTemp1 = array();
                $arrTemp1['path'] = '/resources/resproperty/no-thumb.jpg';
                $arrTemp['respropertyimage'][] = $arrTemp1;
            }
            $arrReturn['data'][] = $arrTemp;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetcomproject($callback = null) {
        $arrReturn = array();
        $arrCourses = array();
        $basePath = 'c:/wamp64/www/admin_upa/';
        $connection = Yii::$app->db;
        $objCourses = $connection->createCommand('Select * from `comproject` c '
                . 'LEFT JOIN `comprojectimage` ci on ci.comprojectid = c.id '
                . 'LEFT JOIN `comprojectcost` cc on cc.id= c.comprojectcostid WHERE c.status = "Active" ')->queryAll();
        foreach ($objCourses AS $objrow) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['id'] = $objrow['id'];
            $arrTemp['name'] = $objrow['name'];
            $arrTemp['location'] = $objrow['location'];
            $arrTemp['landmark'] = $objrow['landmark'];
            $arrTemp['pincode'] = $objrow['pincode'];
            $arrTemp['totalcharges'] = $objrow['totalcharges'];
            $arrTemp['contactno'] = $objrow['contactno'];
            $arrTemp['path'] = $objrow['path'];

            $arrCourses[] = $arrTemp;
        }
        $arrReturn['data'][] = $arrTemp;








//        $arrReturn = array();
////        $arrReturn['status'] = FALSE;
//        $request = Yii::$app->request;
//        $status = 'Active';
//        $objData = Comproject::find(['Active' => $status])->all();
//        foreach ($objData as $key => $value) {
//            $arrReturn = array();
//            $arrReturn['status'] = TRUE;
//            $arrTemp['comproject'] = $value;
//            $arrTemp['amaneties'] = $value->comprojectamaneties->toArray();
//            $arrTemp['comprojectoffice'] = $value->comprojectoffice->toArray();
//            $arrTemp['comprojectimage'] = Comprojectimage::find()->where(['comprojectid' => $value->id])->all();
//            if (!$arrTemp['comprojectimage']) {
//                $arrTemp1 = array();
//                $arrTemp1['path'] = '/resources/comproject/no-thumb.jpg';
//                $arrTemp['comprojectimage'][] = $arrTemp1;
//            }
//            $arrReturn['data'][] = $arrTemp;
//        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetsearchresult($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $status = 'Active';
        $propertyid = (null != $request->get('propertyid') ) ? $request->get('propertyid') : '';
        $location = (null != $request->get('location') ) ? $request->get('location') : '';
        $propertyres = (null != $request->get('propertytype') ) ? $request->get('propertytype') : '';
        $propertynew = (null != $request->get('type') ) ? $request->get('type') : '';
        $propertybhk = (null != $request->get('typeofproperty') ) ? $request->get('typeofproperty') : '';
        $minprice = (null != $request->get('minprice') ) ? $request->get('minprice') : 0;
        $maxprice = (null != $request->get('maxprice') ) ? $request->get('maxprice') : 100000000;
        $connection = Yii::$app->db;
        if ($location) {
            $explodedSearch = explode(" ", $location);
            foreach ($explodedSearch as $search) {
                $query = "SELECT `id`, `name`, `propertyid`, `location`, `city`, `path`, `persquarefeet`, `propertyarea`, `neworold`, `ownername`, `landmark`, `ameneties`, `expectedprice`, `resellrent`, `shoporoffice`, `typeofproperty`, `selectproperty`, `zone`, `selecttype`, `status`
                from searchproperty   WHERE
                `expectedprice` BETWEEN $minprice AND $maxprice
                AND`selectproperty` = '$propertyres'
                || `selecttype` = '$propertynew'
                AND `typeofproperty` = '$propertybhk'
                AND (`location` LIKE '%$search%')
                AND (`city` LIKE '%$search%')
                || `shoporoffice` = '$propertybhk'
                AND  `zone` = '$propertybhk'";
                $objData = $connection->createCommand($query)->queryAll();
                $arrReturn['status'] = TRUE;
                $arrReturn['query'] = $objData;
            }
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetsearchresultbypropertyid($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $status = 'Active';
        $propertyid = (null != $request->get('propertyid') ) ? $request->get('propertyid') : '';
        $connection = Yii::$app->db;
        $query = "SELECT * from searchproperty WHERE propertyid = '$propertyid'";
        $objData = $connection->createCommand($query)->queryAll();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['query'] = $objData;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionCheckpropertyid($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $status = 'Active';
        $searchpropertyid = $request->post('searchpropertyid');
        $objSearchproperty = Searchproperty::find(['propertyid' => 'res1'])->one();
        if ($objSearchproperty) {
            $arrReturn['status'] = TRUE;
        }
        echo json_encode($arrReturn);
        die;
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetresaleproperty($callback = null) {
        $arrReturn = array();
        $request = Yii::$app->request;
        $status = 'Active';
        $objData = Resaleproperty::find()->where(['status' => $status])->orderBy(['added_date' => SORT_DESC])->all();
        foreach ($objData as $key => $value) {
            $arrTemp = array();
            $arrTemp['project'] = $value;
            $arrTemp['resaleimage'] = Resalepropertyimage::find()->where(['resalepropertyid' => $value->id])->all();
            if (!$arrTemp['resaleimage']) {
                $arrTemp1 = array();
                $arrTemp1['path'] = '/resources/resproject/no-thumb.jpg';
                $arrTemp['resaleimage'][] = $arrTemp1;
            }
            $arrReturn['data'][] = $arrTemp;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetresidentialrentproperty($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $status = 'Active';
        $objData = Resaleproperty::find()->where(['resellrent' => "Rent"])->all();

        foreach ($objData as $key => $value) {
            $arrTemp = array();
            $arrTemp['project'] = $value;
            $arrTemp['resprojectimage'] = Resalepropertyimage::find()->where(['resalepropertyid' => $value->id])->all();
            if (!$arrTemp['resprojectimage']) {
                $arrTemp1 = array();
                $arrTemp1['path'] = '/resources/resproject/no-thumb.jpg';
                $arrTemp['resprojectimage'][] = $arrTemp1;
            }
            $arrReturn['data'][] = $arrTemp;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetresprojectamaneties($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $resprojectid = $request->get('resprojectid');
        $objData = Resproject::find()->where(['id' => $resprojectid])->one();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn = array();
            $arrReturn['name'] = $objData->name;
            $arrReturn['amaneties'] = $objData->resprojectamaneties->toArray();
        }
        $arrReturn['data'][] = $arrReturn;
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetcomprojectamaneties($callback = null) {

        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $comprojectid = $request->get('comprojectid');
        $objData = Comproject::find()->where(['id' => $comprojectid])->one();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn = array();
            $arrReturn['name'] = $objData->name;
            $arrReturn['amaneties'] = $objData->comprojectamaneties->toArray();
        }
        $arrReturn['data'][] = $arrReturn;
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetcomconstructiondata($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $comprojectid = $request->get('comprojectid');
        $objData = Comproject::find()->where(['id' => $comprojectid])->one();
        $date = $objData->comextradetails->preleasedrentstartedfrom;
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn = array();
            $arrReturn['name'] = $objData->name;
            $arrReturn['comextradetails'] = $objData->comextradetails->toArray();
            $arrReturn['date'] = date('Y-m-d', strtotime($date));
        }
        $arrReturn['data'][] = $arrReturn;
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetextradetailsdata($callback = null) {

        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $comprojectid = $request->get('comprojectid');
        $objData = Comproject::find()->where(['id' => $comprojectid])->one();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn = array();
            $arrReturn['name'] = $objData->name;
            $arrReturn['comprojectdetails'] = $objData->comprojectdetails->toArray();
        }
        $arrReturn['data'][] = $arrReturn;
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetprojectdata($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $resprojectid = $request->get('resprojectid');
        $objData = Resproject::find()->where(['id' => $resprojectid])->one();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn = array();
            $arrReturn['name'] = $objData->name;
            $arrReturn['projectproject'] = $objData->resprojectproject->toArray();
        }
        $arrReturn['data'][] = $arrReturn;
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionEnquirycustomer($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $status = 'Active';

        $objCustomer = new Customer();
        $objCustomer->name = $request->get('cname');
        $objCustomer->phone = $request->get('cnumber');

        if ($objCustomer->save()) {
            $objFollowup = new Followup();
            $objFollowup->customerid = $objCustomer->id;
            $objFollowup->save();
            $arrReturn['status'] = TRUE;
            //////////////////////MAiL fUNCTION////////////////////////////////

            $date = date('Y-m-d');
            $name = $objCustomer->name;
            $phone = $objCustomer->phone;
            $date = date("Y-m-d");
            $kadam_sir = "ckadam@uniquepaf.com";
            $umesh_sir = "umeshs@uniquepaf.com";
            $uniquepaf = "contact@uniquepaf.com";
            $str = "";
            $str .= "<table border=2>";
            $str .= "<tr><td>Name</td><td>$name</td></tr>";
            $str .= "<tr><td>Phone</td><td>$phone</td></tr>";
            $str .= "</table>";


            $to = "$abhishek_sir";

            $subject = "Customer[$name] has Enqired on Microsite on [$date]";

            $message = $str;

            $header = 'MIME-Version: 1.0' . "\r\n";

            $header = 'From: contact@uniquepaf.com' . "\r\n" .
                    'Reply-To: contact@uniquepaf.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();


            $mail = mail($to, $subject, $message, $header);

            if ($mail) {
                $arrReturn['status'] = TRUE;
            } else {
                $arrReturn['status'] = FALSE;
            }

            ////////////////////////////////////////////
        }

        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetresidentialresaleproperty($callback = null) {

        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $status = 'Active';
        $objData = Resaleproperty::find()->where(['resellrent' => "Resale"])->all();

        foreach ($objData as $key => $value) {
            $arrTemp = array();
            $arrTemp['project'] = $value;
            $arrTemp['resprojectimage'] = Resalepropertyimage::find()->where(['resalepropertyid' => $value->id])->all();
            if (!$arrTemp['resprojectimage']) {
                $arrTemp1 = array();
                $arrTemp1['path'] = '/resources/resproject/no-thumb.jpg';
                $arrTemp['resprojectimage'][] = $arrTemp1;
            }
            $arrReturn['data'][] = $arrTemp;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetsearchcommercialnew($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $status = 'Active';
        $maxprice = $request->get('maxprice');
        $minprice = $request->get('minprice');
        $type = $request->get('type');
        $property = $request->get('property');
        $location = $request->get('location');
        $connection = Yii::$app->db;
        $query = "SELECT * from comproject WHERE (location LIKE '$location%') || (location LIKE '%$location') || (location LIKE '%$location%') || (city LIKE '$location%')  || (city LIKE '%$location') || (city LIKE '%$location%') AND expectedprice BETWEEN $minprice AND $maxprice";
        $objData = $connection->createCommand($query)->queryAll();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            foreach ($objData as $key => $value) {

                $arrTemp = array();
                $arrTemp['comproject'] = $value;
                $arrTemp['builder'] = Builder::find()->where(['id' => $value['builderid']])->all();
                $arrTemp['amaneties'] = Comprojectamaneties::find()->where(['id' => $value['comprojectamanetiesid']])->all();
                $arrTemp['comprojectoffice'] = Comprojectoffice::find()->where(['id' => $value['comprojectofficeid']])->all();
                $arrTemp['comprojectdetails'] = Comprojectdetails::find()->where(['id' => $value['comprojectdetailsid']])->all();
                $arrTemp['comprojectproject'] = comprojectproject::find()->where(['id' => $value['comprojectprojectid']])->all();

                $arrTemp['comprojectimage'] = Comprojectimage::find()->where(['comprojectid' => $value['comprojectofficeid']])->all();
                if (!$arrTemp['comprojectimage']) {
                    $arrTemp1 = array();
                    $arrTemp1['path'] = '/resources/comproject/no-thumb.jpg';
                    $arrTemp['comprojectimage'][] = $arrTemp1;
                }
                $arrReturn['data'][] = $arrTemp;
            }
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

    public function actionGetblogbyid($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $status = 'publish';
        $request = Yii::$app->request;
        $id = $request->get('id');
        if ($id != 0) {
            $objData = Blog:: findOne(['id' => $id, 'status' => $status]);
        } else {
            $objData = Blog:: find(['status' => $status])->orderBy(['date' => SORT_DESC])->one();
        }

        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objData;
        }
        // set "fomat" property
        Yii::$app->getResponse()->format = (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
                $arrReturn :
                array(
            'data' => $arrReturn,
            'callback' => $callback
        );
    }

}

// end of DashboardController.php
