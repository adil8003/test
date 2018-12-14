<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Userroles;
use app\models\Status;
use app\models\Newarrivalproduct;
use app\models\Productstatus;
use app\models\Shirtimages;

class NewarrivalsController extends Controller {

    public $enableCsrfValidation = false;
    public $userid = '';
    public $base_path = 'C:\wamp\www\kiwings/';

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

    public function actionEdit() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objProductstatus = Productstatus::find()->all();
        $objStatus = Status::find()->all();
        $objNewarrivalproduct = Newarrivalproduct::findOne($id);
        return $this->render('edit', [
                    'objProductstatus' => $objProductstatus,
                    'objStatus' => $objStatus,
                    'objNewarrivalproduct' => $objNewarrivalproduct
        ]);
    }

    public function actionAdd() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objProductstatus = Productstatus::find()->all();
        $objStatus = Status::find()->all();
        return $this->render('add', [
                    'objProductstatus' => $objProductstatus,
                    'objStatus' => $objStatus
        ]);
    }

    public function actionError() {
        return $this->render('error', [
        ]);
    }

    public function actionUploadproductimae() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        if (!empty($_FILES)) {
            $uploaddir = 'resources/shirts/';
            $image_name = md5(date('Ymdhis'));
            $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
            $file = $_FILES["file"]['tmp_name'];
            list($width, $height) = getimagesize($file);
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
//                if (($width < "255" || $width > "255") || ($height < "291" || $height > "291")) {
//                    $arrReturn['error'] = ('error img size');
//                } else {
                    $request = Yii::$app->request;
                    $id = $request->get('id');
                    $objNewarrivalproduct = Newarrivalproduct::find()->where(['id' => $id])->One();
                    $objNewarrivalproduct->productimg = $uploadfile;
                    if ($objNewarrivalproduct->save()) {
                        $arrReturn['status'] = TRUE;
                    } else {
                        $arrReturn['msg'] = 'Try again.';
                    }
//                }
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionGetproductbyid() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $id = $request->get('id');
        $objNewarrivalproduct = Newarrivalproduct :: find()->where(['id' => $id])->one();
        if ($id != '') {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objNewarrivalproduct->toArray();
        }
        echo json_encode($arrReturn);
        die;
    }

    public function actionUpdateproduct() {
        $transaction = Yii::$app->db->beginTransaction();
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            try {
                $id = $request->post('id');
                if ($id != 0) {
                    $objNewarrivalproduct = Newarrivalproduct::find()->where(['id' => $id])->One();
                    $objNewarrivalproduct->title = $request->post('title');
                    $objNewarrivalproduct->subtitle = $request->post('subtitle');
                    $objNewarrivalproduct->price = $request->post('price');
                    $objNewarrivalproduct->statusid = $request->post('statusid');
                    $objNewarrivalproduct->productstatusid = $request->post('productstatusid');

                    if ($objNewarrivalproduct->save()) {
                        $arrReturn['status'] = TRUE;
                        $arrReturn['id'] = $objNewarrivalproduct->id;
                        $arrReturn['msg'] = 'save successfully.';
                    } else {
                        $arrReturn['orgerr'][] = $objNewarrivalproduct->getErrors();
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

    public function actionSaveproduct() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        $request = Yii::$app->request;
        $this->layout = "";
        $title = $request->get('title');
        $subtitle = $request->get('subtitle');
        $price = $request->get('price');
        $statusid = $request->get('statusid');
        $productstatusid = $request->get('productstatusid');
        $offer = $request->get('offer');
        $offerprice = $offer / 100 * $price;
        $finalprice = $price - $offerprice;
        if ($request->isPost) {
            $objNewarrivalproduct = new \app\models\Newarrivalproduct();
            $objNewarrivalproduct->title = $title;
            $objNewarrivalproduct->subtitle = $subtitle;
            $objNewarrivalproduct->price = $price;
            $objNewarrivalproduct->statusid = $statusid;
            $objNewarrivalproduct->productstatusid = $productstatusid;
            $objNewarrivalproduct->offerprice = $finalprice;
            $objNewarrivalproduct->offer = $offer;
            if ($objNewarrivalproduct->save()) {
                $arrReturn['status'] = TRUE;
                $arrReturn['id'] = $objNewarrivalproduct->id;
                $arrReturn['msg'] = 'save successfully.';
                if (!empty($_FILES)) {
                    $uploaddir = 'resources/shirts/';
                    $image_name = md5(date('Ymdhis'));
                    if (count($_FILES) > 0) {
                        foreach ($_FILES as $filename) {
                            $uploaddir = 'resources/shirts/';
                            $image_name = md5(date('Ymdhis')) . rand(1000, 9999);
                            $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                            $arrlistimg[] = $uploadfile;
                            $file = $filename['tmp_name'];
                            list($width, $height) = getimagesize($file);
                            if (move_uploaded_file($filename['tmp_name'], $uploadfile)) {
//                                if (($width < "255" || $width > "255") || ($height < "291" || $height > "291")) {
//                                    $arrReturn['error'] = ('error img size');
//                                } else {
                                    $transaction = Yii::$app->db->beginTransaction();
                                    try {
                                        $objShirtimages = new Shirtimages();
                                        $objShirtimages->newarrivalproductid = $objNewarrivalproduct->id;
                                        $objShirtimages->type = 3;
                                        $objShirtimages->imgtype = 'newcat';
                                        $objShirtimages->images = $uploadfile;
                                        if ($objShirtimages->save()) {
                                            $arrReturn['status'] = TRUE;
                                            $arrReturn['id'] = $objShirtimages->id;
                                            $arrReturn['msg'] = 'save successfully.';
                                        } else {
                                            $arrReturn['crmerr'][] = $objShirtimages->getErrors();
                                        }

                                        $transaction->commit();
                                    } catch (Exception $ex) {
                                        $arrReturn['curexp'] = $e->getMessage();
                                        $transaction->rollBack();
                                    }
//                                }
                            }
                        }
                    }
                }
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionAllnewproduct() {
        $arrJSON = array();
        $arrProduct = array();
        $connection = Yii::$app->db;
//        $objNewproduct = $connection->createCommand('Select * from newarrivalproduct n LEFT join shirtimages s on s.newarrivalproductid = n.id where statusid = '. 2 .' ORDER BY n.addeddate DESC ')->queryAll();
        $objNewproduct = $connection->createCommand('Select * from newarrivalproduct n  where statusid = '. 2 .' ORDER BY n.addeddate DESC ')->queryAll();
        foreach ($objNewproduct AS $objrow) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['id'] = $objrow['id'];
            $arrTemp['title'] = $objrow['title'];
            $arrTemp['subtitle'] = $objrow['subtitle'];
            $arrTemp['price'] = $objrow['price'];
            $arrTemp['offer'] = $objrow['offer'];
            $arrTemp['offerprice'] = $objrow['offerprice'];
            $arrTemp['statusid'] = $objrow['statusid'];
            $arrTemp['productstatusid'] = $objrow['productstatusid'];
            $arrTemp['addeddate'] = date('d-m-Y', strtotime($objrow['addeddate']));

            $arrProduct[] = $arrTemp;
        }
        $arrJSON['data'] = $arrProduct;
        echo json_encode($arrJSON);
    }
     public function actionGetofferprice1() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objTrenddingproduct = \app\models\Newarrivalproduct::findOne(['id' => $id]);
                $Offer = $objTrenddingproduct->offer;
                $price = $request->post('price');
                $offerprice = $Offer / 100 * $price;
                $finalprice = $price - $offerprice;
                if ($finalprice != '') {
                    $arrReturn['status'] = TRUE;
                    $arrReturn['data'] = $finalprice;
                }
            }
            echo json_encode($arrReturn);
            die;
        }
        echo json_encode($arrReturn);
    }
public function actionUploadeshirtimage() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        $request = Yii::$app->request;
        $this->layout = "";
        $newarrivalproductid = $request->get('newarrivalproductid');
        if ($newarrivalproductid != 0) {
            if (!empty($_FILES)) {
                $uploaddir = 'resources/shirts/';
                $image_name = md5(date('Ymdhis'));
                if (count($_FILES) > 0) {
                    foreach ($_FILES as $filename) {
                        $uploaddir = 'resources/shirts/';
                        $image_name = md5(date('Ymdhis')) . rand(1000, 9999);
                        $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                        $arrlistimg[] = $uploadfile;
                        $file = $filename['tmp_name'];
                        list($width, $height) = getimagesize($file);
                        if (move_uploaded_file($filename['tmp_name'], $uploadfile)) {
//                            if (($width < "255" || $width > "255") || ($height < "291" || $height > "291")) {
//                                $arrReturn['error'] = ('error img size');
//                            } else {
                                $transaction = Yii::$app->db->beginTransaction();
                                try {
                                    $objShirtimages = new Shirtimages();
                                    $objShirtimages->newarrivalproductid = $newarrivalproductid;
                                    $objShirtimages->type = 3;
                                    $objShirtimages->imgtype = 'newcat';
                                    $objShirtimages->images = $uploadfile;
                                    if ($objShirtimages->save()) {
                                        $arrReturn['status'] = TRUE;
                                        $arrReturn['id'] = $objShirtimages->id;
                                        $arrReturn['msg'] = 'save successfully.';
                                    } else {
                                        $arrReturn['crmerr'][] = $objShirtimages->getErrors();
                                    }

                                    $transaction->commit();
                                } catch (Exception $ex) {
                                    $arrReturn['curexp'] = $e->getMessage();
                                    $transaction->rollBack();
                                }
//                            }
                        }
                    }
                }
            }
        }
        echo json_encode($arrReturn);
    }
    public function actionLinkproductimage() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objNewarrivalproduct = Shirtimages::findOne($id);
        $file = $objNewarrivalproduct->images;

        header('Content-type: resources/jpg');
        readfile($file);
    }
     public function actionGetimages() {
        $arrResidential['status'] = FALSE;
        $arrJSON = array();
        $arrResidential = array();
        $this->layout = "";
        $request = Yii::$app->request;
        $id = $request->post('id');
        $connection = Yii::$app->db;
        $objData = $connection->createCommand('Select *
                        from `shirtimages` s 
                       where s.newarrivalproductid = ' . $id . '  ORDER BY `addeddate` DESC ')->queryAll();
        foreach ($objData AS $objrow) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['id'] = $objrow['id'];
            $arrTemp['images'] = $objrow['images'];
            $arrTemp['type'] = $objrow['type'];
            $arrTemp['imgtype'] = $objrow['imgtype'];
            $arrTemp['addeddate'] = date('M-d,Y', strtotime($objrow['addeddate']));
            $arrResidential[] = $arrTemp;
        }
        $arrJSON['data'] = $arrResidential;
        echo json_encode($arrJSON);
     }

}

// end of DashboardController.php
