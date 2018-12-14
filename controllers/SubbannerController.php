<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Banner;
use app\models\Status;
use app\models\Subbanner;

class SubbannerController extends Controller {

    public $enableCsrfValidation = false;
    public $userid = '';
    public $base_path = 'C:\wamp\www\festone/';

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

    public function actionEditbanner() {
        return $this->render('editbanner', [
        ]);
    }

    public function actionError() {
        return $this->render('error', [
        ]);
    }

    public function actionUploadbanner2() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        if (!empty($_FILES)) {
            $uploaddir = 'resources/users/';
            $image_name = md5(date('Ymdhis'));
            $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $objSubbanner = Subbanner:: findOne(2);
                $objSubbanner->subimg = $uploadfile;
                $objSubbanner->title = 'd';
                $objSubbanner->subtitle = 'k';
                $objSubbanner->num = 2;
                if ($objSubbanner->save()) {
                    $arrReturn['status'] = TRUE;
                    $arrReturn['id'] = $objSubbanner->id;
                    $arrReturn['msg'] = 'save successfully.';
                }
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionUploadbanner() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        if (!empty($_FILES)) {
            $uploaddir = 'resources/users/';
            $image_name = md5(date('Ymdhis'));
            $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
            $file = $_FILES["file"]['tmp_name'];
            list($width, $height) = getimagesize($file);
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                if ($width < "600" && $height < "300") {

                    $arrReturn['error'] = ('error img size');
                } else {
                    $objSubbanner = Subbanner:: findOne(1);
                    $objSubbanner->subimg = $uploadfile;
                    $objSubbanner->title = 'd';
                    $objSubbanner->subtitle = 'k';
                    $objSubbanner->num = 1;
                    if ($objSubbanner->save()) {
                        $arrReturn['status'] = TRUE;
                        $arrReturn['id'] = $objSubbanner->id;
                        $arrReturn['msg'] = 'save successfully.';
                    }
                }
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionGetbannerimagebyid() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $id = 1;
        $objSubbanner = Subbanner:: find()->where(['id' => $id])->one();
        if ($id != '') {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objSubbanner->subimg;
            $arrReturn['title'] = $objSubbanner->title;
            $arrReturn['subtitle'] = $objSubbanner->subtitle;
        }
        echo json_encode($arrReturn);
        die;
    }

    public function actionGetbannerimagebyid2() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $id = 2;
        $objSubbanner = Subbanner:: find()->where(['id' => $id])->one();
        if ($id != '') {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objSubbanner->subimg;
            $arrReturn['title'] = $objSubbanner->title;
            $arrReturn['subtitle'] = $objSubbanner->subtitle;
        }
        echo json_encode($arrReturn);
        die;
    }

    public function actionAddtwo() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        $request = Yii::$app->request;
        $this->layout = "";
        $title = $request->get('title');
        $subtitle = $request->get('subtitle');
        $id = $request->get('id');
        if ($request->isPost) {
            if (!empty($_FILES)) {
                $uploaddir = 'resources/users/';
                $image_name = md5(date('Ymdhis'));
                $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                $file = $_FILES["file"]['tmp_name'];
                list($width, $height) = getimagesize($file);
                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                    if (($width < "600" || $width > "600") || ($height < "300" || $height > "300")) {
                       
                        $arrReturn['error'] = ('error img size');
                    } else {
                        $objBanner = Subbanner :: find()->where(['id' => 2])->one();
                        $objBanner->title = $title;
                        $objBanner->subtitle = $subtitle;
                        $objBanner->subimg = $uploadfile;
                        $objBanner->num = 2;
                        if ($objBanner->save()) {
                            $arrReturn['status'] = TRUE;
                            $arrReturn['id'] = $objBanner->id;
                            $arrReturn['msg'] = 'save successfully.';
                        }
                    }
                }
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionAddone() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        $request = Yii::$app->request;
        $this->layout = "";
        $title = $request->get('title');
        $subtitle = $request->get('subtitle');
        $id = $request->get('id');
        if ($request->isPost) {
            if (!empty($_FILES)) {
                $uploaddir = 'resources/users/';
                $image_name = md5(date('Ymdhis'));
                $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                $file = $_FILES["file"]['tmp_name'];
                list($width, $height) = getimagesize($file);
                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                   if (($width < "600" || $width > "600") || ($height < "300" || $height > "300")) {
                        $arrReturn['error'] = ('error img size');
                    } else {
                        $objBanner = Subbanner :: find(['id' > 1])->one();
                        $objBanner->title = $title;
                        $objBanner->subtitle = $subtitle;
                        $objBanner->subimg = $uploadfile;
                        $objBanner->num = 2;
                        if ($objBanner->save()) {
                            $arrReturn['status'] = TRUE;
                            $arrReturn['id'] = $objBanner->id;
                            $arrReturn['msg'] = 'save successfully.';
                        }
                    }
                }
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionDeleteaddone() {
        $basePath = Yii::$app->params['basePath'];
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objSubbanner = Subbanner ::findOne(['id' => $id]);
                $objSubbanner->subimg = $basePath . '/resources/users/no_image.jpg';
                $objSubbanner->save();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'Deleted successfully.';
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionDeleteaddtwo() {
        $basePath = Yii::$app->params['basePath'];
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objSubbanner = Subbanner ::findOne(['id' => $id]);
                $objSubbanner->subimg = $basePath . '/resources/users/no_image.jpg';
                $objSubbanner->save();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'Deleted successfully.';
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionLinkbannerimage2() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objSubbanner = Subbanner::findOne(2);
        $file = $objSubbanner->subimg;

        header('Content-type: resources/jpg');
        readfile($file);
    }

    public function actionLinkbannerimage() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objSubbanner = Subbanner::findOne(1);
        $file = $objSubbanner->subimg;

        header('Content-type: resources/jpg');
        readfile($file);
    }

    public function actionLinkbannerimage3() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objSubbanner = Subbanner::findOne(3);
        $file = $objSubbanner->subimg;

        header('Content-type: resources/jpg');
        readfile($file);
    }

}

// end of DashboardController.php
