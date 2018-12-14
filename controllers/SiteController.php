<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use yii\web\View;
use app\models\Users;
use app\models\Organisation;
use app\models\Status;

class SiteController extends Controller {

    public $enableCsrfValidation = false;

    public function init() {
        Yii::$app->session['isLoggedIn'] = false;
    }

    public function actionIndex() {
        if (Yii::$app->session['isLoggedIn'] == true) {
            return $this->redirect('index.php?r=dashboard');
        } else {
            return $this->redirect('index.php?r=site/login');
        }
    }

    public function actionLogin() {
//        echo md5('kiwings');die;
        $this->layout = "login";
        return $this->render('login');
    }

    public function actionVerification() {
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $model = new Users();
            $objUsers = $model->findOne(['email' => $request->post('email')]);
            if ($objUsers && ($request->post('password')) == $objUsers->password) {
                Yii::$app->session['isLoggedIn'] = true;
                Yii::$app->session['userid'] = $objUsers->id;
                Yii::$app->session['name'] = $objUsers->name;
                Yii::$app->session['email'] = $objUsers->email;
                return $this->redirect('index.php?r=dashboard');
            }
        }

        return $this->redirect('index.php?r=site/login');
    }

    public function actionLogout() {
        Yii::$app->session['isLoggedIn'] = false;
        Yii::$app->session['username'] = '';
        Yii::$app->session['email'] = '';
        Yii::$app->session['status'] = '';
        Yii::$app->session['role'] = '';
        return $this->redirect('index.php?r=site/login');
    }

    public function actionError() {
        $this->layout = "login";
        echo "Hi error";
        die;
    }

    public function actionCheckpassword() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $password = ($request->post('password'));
        $objUser = Users::findOne(['password' => ($password)]);
        if ($objUser) {
            $arrReturn['status'] = TRUE;
        }
        echo json_encode($arrReturn);
        die;
    }

    public function actionForgotpassword() {
        $this->layout = "forgotpassword";
        return $this->render('forgotpassword', [
        ]);
    }

    public function actionCheckemail() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $email = ($request->post('email'));
        $objEmail = User::find()->where(['email' => $email])->one();
        if ($objEmail) {
            $arrReturn['status'] = TRUE;
        }
        echo json_encode($arrReturn);
        die;
    }

    public function actionSavenewpassword() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $email = ($request->post('email'));
            $password = ($request->post('password'));
            if ($email != '') {
                $objUser = User::findOne(['email' => $email]);
                $objUser->password = md5($password);
                $objUser->save();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'password change successfully.';
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

}

// end of SiteController.php
