<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\widgets\FileInput;
use app\models\User;
use app\models\Banner;
use app\models\Status;

class BannerController extends Controller {

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
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objBanner = Banner::findOne($id);
        $objStatus = Status::find()->all();
        return $this->render('editbanner', [
                    'objBanner' => $objBanner,
                    'objStatus' => $objStatus
        ]);
    }

    public function actionError() {
        return $this->render('error', [
        ]);
    }

    public function actionDeletebannerimg() {
        $basePath = Yii::$app->params['basePath'];
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objBanner = Banner::findOne(['id' => $id]);
                $objBanner->bannerimg = $basePath . '/resources/banner/no_image.jpg';
                $objBanner->save();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'Deleted successfully.';
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionDeletebanner() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objBanner = Banner::findOne(['id' => $id]);
                $objBanner->statusid = $request->post('statusid');
                $objBanner->save();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'Deleted successfully.';
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionUpdatebanner() {
        $transaction = Yii::$app->db->beginTransaction();
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            try {
                $id = $request->post('id');
                if ($id != 0) {
                    $objBanner = Banner::find()->where(['id' => $id])->One();
                    $objBanner->title = $request->post('title');
                    $objBanner->subtitle = $request->post('subtitle');
                    $objBanner->statusid = $request->post('statusid');
                    if ($objBanner->save()) {
                        $arrReturn['status'] = TRUE;
                        $arrReturn['id'] = $objBanner->id;
                        $arrReturn['msg'] = 'save successfully.';
                    } else {
                        $arrReturn['orgerr'][] = $objBanner->getErrors();
                    }
                }
                $transaction->commit();
                yii::info('all modal saved');
            } catch (Exception $ex) {
                $arrReturn['curexp'] = $e->getMessage();
                $transaction->rollBack();
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionGetbannerimagebyid() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $id = $request->post('id');
        $objBanner = Banner :: find()->where(['id' => $id])->one();

        if ($id != '') {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objBanner->toArray();
        }
        echo json_encode($arrReturn);
        die;
    }

    public function actionSavebanner() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        $request = Yii::$app->request;
        $this->layout = "";
        $title = $request->get('title');
        $subtitle = $request->get('subtitle');
        if ($request->isPost) {
            if (!empty($_FILES)) {
                $uploaddir = 'resources/banner/';
                $image_name = md5(date('Ymdhis'));
                $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                $file = $_FILES["file"]['tmp_name'];
                list($width, $height) = getimagesize($file);
                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                    if ($width < "1680" && $height < "700") {

                        $arrReturn['error'] = ('error img size');
                    } else {
                        $objBanner = new Banner();
                        $objBanner->title = $title;
                        $objBanner->subtitle = $subtitle;
                        $objBanner->bannerimg = $uploadfile;
                        $objBanner->statusid = 2;
                        if ($objBanner->save()) {
                            $arrReturn['status'] = TRUE;
                            $arrReturn['id'] = $objBanner->id;
                            $arrReturn['msg'] = 'save successfully.';
                            $arrReturn['img-error'] = ('error img size');
                        }
                    }
                }
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionUploadbanner() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            if (!empty($_FILES)) {
                $uploaddir = 'resources/banner/';
                $image_name = md5(date('Ymdhis'));
                $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                $file = $_FILES["file"]['tmp_name'];
                list($width, $height) = getimagesize($file);
                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                    if ($width < "1680" && $height < "700") {

                         $arrReturn['data'] =  'error img size';
                    } else {
                        $arrReturn['msg'] = ('successfully uploaded');
                        $request = Yii::$app->request;
                        $id = $request->get('id');
                        $objBanner = Banner::find()->where(['id' => $id])->One();
                        $objBanner->bannerimg = $uploadfile;
                        $objBanner->statusid = 2;
                        if ($objBanner->save()) {
                            $arrReturn['status'] = TRUE;
//                            $arrReturn['id'] = $objBanner->id;
                            $arrReturn['msg'] = 'save successfully.';
                        }
                    }
                }
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionAllbanner() {
        $arrJSON = array();
        $arrBanner = array();
        $connection = Yii::$app->db;
        $objData = $connection->createCommand('Select * from banner
                       where statusid = ' . 2 . '  ORDER BY `addeddate` DESC ')->queryAll();
        foreach ($objData AS $objrow) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['id'] = $objrow['id'];
            $arrTemp['title'] = $objrow['title'];
            $arrTemp['subtitle'] = $objrow['subtitle'];
            $arrTemp['subtitle'] = $objrow['subtitle'];
            $arrTemp['bannerimg'] = $objrow['bannerimg'];
            $arrTemp['addeddate'] = date('d-m-Y', strtotime($objrow['addeddate']));

            $arrBanner[] = $arrTemp;
        }
        $arrJSON['data'] = $arrBanner;
        echo json_encode($arrJSON);
    }

    public function actionLinkbannerimage() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objBanner = Banner::findOne($id);
        $file = $objBanner->bannerimg;

        header('Content-type: resources/jpg');
        readfile($file);
    }

}

// end of DashboardController.php
