<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Users;
use app\models\Status;

class ProfileController extends Controller {

    public $enableCsrfValidation = false;
    public $userid = '';

    public function init() {
        if (Yii::$app->session['isLoggedIn'] != true) {
            return $this->redirect('index.php?r=site/login');
        }
        $this->layout = "dashboard";
    }

    public function actionIndex() {
        return $this->render('index', [
        ]);
    }

    public function actionError() {
        return $this->render('error', [
        ]);
    }

    public function actionGetuserdetailsbyid() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $objData = Users:: findOne(['id' => Yii::$app->session['userid']]);
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['name'] = $objData->name;
            $arrReturn['address'] = $objData->address;
            $arrReturn['email'] = $objData->email;
            $arrReturn['mobile'] = $objData->mobile;
            $arrReturn['image'] = $objData->image;
        }
        echo json_encode($arrReturn);
        die;
    }

    public function actionUpdateuser() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objUser = Users::find()->where(['id' => $id])->one();
                $objUser->name = $request->post('name');
                $objUser->address = $request->post('address');
                $objUser->email = $request->post('email');
                $objUser->mobile = $request->post('mobile');
                if ($objUser->save()) {
                    $arrReturn['status'] = TRUE;
                    $arrReturn['id'] = $objUser->id;
                    Yii::$app->session['name'] = $objUser->name;
                }
            }
            echo json_encode($arrReturn);
        }
    }

    public function actionLinkuserimage() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objUser = Users::findOne($id);
        $file = $objUser->image;

        header('Content-type: resources/png');
        readfile($file);
    }

    public function actionUploadusserprofilepic() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        if (!empty($_FILES)) {
            $uploaddir = 'resources/users/';
            $image_name = md5(date('Ymdhis'));
            $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $request = Yii::$app->request;
                $id = $request->get('id');
                $objUser = Users::findOne(['id' => Yii::$app->session['userid']]);
                $objUser->image = $uploadfile;
                $objUser->save();
                $arrReturn['status'] = TRUE;
            } else {
                $arrReturn['msg'] = 'Try again.';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionDeleteuserprofilepic() {
        $basePath = Yii::$app->params['basePath'];
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objUser = Users::findOne(['id' => $id]);
                $objUser->image = $basePath . '/resources/users/no_image.jpg';
                $objUser->save();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'Deleted successfully.';
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionGetuserimagebyid() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $id = $request->post('id');
        $objUser = Users :: findone(['id' => Yii::$app->session['userid']]);
        if ($id != '') {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objUser->toArray();
        }
        echo json_encode($arrReturn);
        die;
    }

    public function actionChangepassword() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objUser = Users::findOne(['id' => Yii::$app->session['userid']]);
                $objUser->password = ($request->post('password'));
                $objUser->save();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'Save successfully.';
//                //////////////////////MAiL fUNCTION////////////////////////////////
//                $date = date('Y-m-d');
//                $name = $objUser->fullname;
//                $email = $objUser->email;
//                $password = $objUser->password;
//                $header = ' IMGAPTI TECH SOLUTIONS PRIVATE LIMITED ';
//                $logo = 'http://mcctv.in/images/Imgapti_horizontal_logo.png';
//                $comURL = 'http://mcctv.in/';
//                $companyemail = 'contact@mcctv.in';
//
//                $body = "<div class='jumbotron' >
//                                <p  class= 'setPOne fontBold'><b>Hi</b> " . $name . ",</p>
//                                <p  class= 'headSetFont'>New password details below .</p>
//                                <p  class= 'setPOne fontBold'><b>Username: </b>" . $email . "<br></p>
//                                <p  class= 'setPOne fontBold'><b>New password: </b> " . $password . "<br></p>
//                                <p  class= 'setPOne fontBold'><b>Url:</b> " . $comURL . "<br></p>
//                                <p  class= 'setPOne fontBold'><b>Thank you. </b> <br></p>
//                                <p  class= 'setPOne'>Please feel free to contact us for any queries: $companyemail<br></p>
//                                     <hr>
//                                </p>
//                        </div>";
//                // to customer
//                $arrMailDetails = Array();
//                $arrMailDetails['subject'] = 'Password changed successfully';
//                $arrMailDetails['toemail'] = $objUser->email;
//                $arrMailDetails['body'] = $body;
//                $objMail = new Mail();
//                $objMail->sendEmail($arrMailDetails);
//                }
                ////////////////////////////////////////////
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionCheckcurrentpass() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $currentpassword = ($request->post('currentpassword'));
        $id = $request->post('id');
        $objUser = Users::find()->where(['id' => Yii::$app->session['userid']])->andWhere(['password' => ($currentpassword)])->one();
        if ($objUser) {
            $arrReturn['status'] = TRUE;
        }
        echo json_encode($arrReturn);
        die;
    }

}

// end of ProfileController.php
