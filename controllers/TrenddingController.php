<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Userroles;
use app\models\Status;
use app\models\Trendding;
use app\models\Trenddingproduct;
use app\models\Shirtimages;

class TrenddingController extends Controller {

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
        $objTstatus = Status::find()->all();
        return $this->render('index', [
                    'objTstatus' => $objTstatus
        ]);
    }

    public function actionAdd() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objProductstatus = \app\models\Productstatus::find()->all();
        $objProducttype = \app\models\Producttype::find()->all();
        $objStatus = Status::find()->all();
        $objTrendding = Trendding::findOne($id);
        $objTstatus = Status::find()->all();
        return $this->render('add', [
                    'objTrendding' => $objTrendding,
                    'objStatus' => $objStatus,
                    'objProductstatus' => $objProductstatus,
                    'objProducttype' => $objProducttype,
                    'objTstatus' => $objTstatus
        ]);
    }

    public function actionEdittrendding() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objProductstatus = \app\models\Productstatus::find()->all();
        $objProducttype = \app\models\Producttype::find()->all();
        $objTstatus = Status::find()->all();
        $objTrendding = Trendding::findOne($id);
        return $this->render('edittrendding', [
                    'objTrendding' => $objTrendding,
                    'objTstatus' => $objTstatus,
                    'objProducttype' => $objProducttype,
                    'objProductstatus' => $objProductstatus
        ]);
    }

    public function actionAddimage() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objProductstatus = \app\models\Productstatus::find()->all();
        $objProducttype = \app\models\Producttype::find()->all();
        $objStatus = Status::find()->all();
        $objTrenddingproduct = Trenddingproduct::findOne($id);
        return $this->render('addimage', [
                    'objTrenddingproduct' => $objTrenddingproduct,
                    'objStatus' => $objStatus,
                    'objProducttype' => $objProducttype,
                    'objProductstatus' => $objProductstatus
        ]);
    }

    public function actionError() {
        return $this->render('error', [
        ]);
    }

    public function actionUploadeshirtimage() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        $request = Yii::$app->request;
        $this->layout = "";
        $shirtcategoriesid = $request->get('shirtcategoriesid');
        if ($shirtcategoriesid != 0) {
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
                                $objShirtimages->trenddingproductid = $shirtcategoriesid;
                                $objShirtimages->type = 2;
                                $objShirtimages->imgtype = 'trendcat';
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
                       where s.trenddingproductid = ' . $id . '  ORDER BY `addeddate` DESC ')->queryAll();
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

    public function actionLinkshirtimage() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objShirtimages = \app\models\Shirtimages::find()->where(['id' => $id])->one();
        $file = $objShirtimages->images;
        header('Content-type: resources/png');
        readfile($file);
    }

    public function actionUploadtrenddingimae() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        $request = Yii::$app->request;
        if (!empty($_FILES)) {
            if ($id = $request->get('id') == 1) {
                $uploaddir = 'resources/users/';
                $image_name = md5(date('Ymdhis'));
                $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                $file = $_FILES["file"]['tmp_name'];
                list($width, $height) = getimagesize($file);
//                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
//                    if (($width < "510" || $width > "510") || ($height < "620" || $height > "620")) {
//                        $arrReturn['error'] = ('error img size');
//                    } else {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {

                        $id = $request->get('id');
                        $objTrendding = Trendding::find()->where(['id' => $id])->one();
                        $objTrendding->trendingimg = $uploadfile;
                        $objTrendding->save();
                        $arrReturn['status'] = TRUE;
                    } else {
                        $arrReturn['msg'] = 'Try again.';
                    }
//                    }
//                }
            } else {
                $uploaddir = 'resources/users/';
                $image_name = md5(date('Ymdhis'));
                $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                $file = $_FILES["file"]['tmp_name'];
                list($width, $height) = getimagesize($file);
//                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {

//                    if (($width < "650" || $width > "650") || ($height < "280" || $height > "280")) {
//
//                        $arrReturn['error'] = ('error img size');
//                    } else {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                        $request = Yii::$app->request;
                        $id = $request->get('id');
                        $objTrendding = Trendding::find()->where(['id' => $id])->one();
                        $objTrendding->trendingimg = $uploadfile;
                        $objTrendding->save();
                        $arrReturn['status'] = TRUE;
                    } else {
                        $arrReturn['msg'] = 'Try again.';
                    }
//                    }
//                }
            }
        }

        echo json_encode($arrReturn);
    }

    public function actionUploadtrenddingproductimage() {
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
                $objTrendding = Trenddingproduct::find()->where(['id' => $id])->one();
                $objTrendding->image = $uploadfile;
                $objTrendding->save();
                $arrReturn['status'] = TRUE;
            } else {
                $arrReturn['msg'] = 'Try again.';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionLinkcourseimage() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objTrendding = Trendding::findOne($id);
        $file = $objTrendding->trendingimg;

        header('Content-type: resources/jpg');
        readfile($file);
    }

    public function actionLinkproductimage() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objTrenddingproduct = Trenddingproduct::findOne($id);
        $file = $objTrenddingproduct->image;

        header('Content-type: resources/jpg');
        readfile($file);
    }

    public function actionDeletimage() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $basePath = Yii::$app->params['basePath'];
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objTrendding = Trendding::findOne(['id' => $id]);
                $objTrendding->trendingimg = $basePath . '/resources/users/no_image.jpg';
                $objTrendding->save();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'Deleted successfully.';
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionDeletproduct() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $basePath = Yii::$app->params['basePath'];
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objTrenddingproduct = Trenddingproduct::findOne(['id' => $id]);
                $objTrenddingproduct->delete();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'Deleted successfully.';
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionGetofferprice() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $trenddingid = $request->post('trenddingid');
            if ($trenddingid != 0) {
                $objTrendding = Trendding::findOne(['id' => $trenddingid]);
                $Offer = $objTrendding->offer;
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

    public function actionGettrendbyid() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $id = $request->get('id');
        $objTrendding = Trendding:: findone($id);
        if ($id != '') {
            $arrReturn['status'] = TRUE;
            $arrReturn['data'] = $objTrendding->toArray();
        }
        echo json_encode($arrReturn);
        die;
    }

    public function actionUpdattrendding() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $id = $request->post('id');
        if ($request->isPost) {
            if ($id != 0) {
                $objTrendding = Trendding::find()->where(['id' => $id])->One();
                $objTrendding->title = $request->post('title');
                $objTrendding->subtitle = $request->post('subtitle');
                $objTrendding->offer = $request->post('offer');
                $objTrendding->statusid = 2;
                if ($objTrendding->save()) {
                    $arrReturn['status'] = TRUE;
                    $arrReturn['id'] = $objTrendding->id;
                    $arrReturn['msg'] = 'save successfully.';
                }
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionSavetrendding() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $basePath = Yii::$app->params['basePath'];
        $request = Yii::$app->request;
        $this->layout = "";
        $title = $request->get('title');
        $subtitle = $request->get('subtitle');
        $statusid = $request->get('statusid');
        $offer = $request->get('offer');
        $objTrendding = Trendding::find()->all();
        $DataCount = count($objTrendding);
        if ($DataCount === 0 || $DataCount === '') {
            if ($request->isPost) {
                if (!empty($_FILES)) {
                    $uploaddir = 'resources/users/';
                    $image_name = md5(date('Ymdhis'));
                    $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                    $file = $_FILES["file"]['tmp_name'];
                    list($width, $height) = getimagesize($file);
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
//                        if (($width < "510" || $width > "510") || ($height < "620" || $height > "620")) {
//                            $arrReturn['error'] = ('error img size');
//                        } else {
                        $objTrendding = new Trendding();
                        $objTrendding->title = $title;
                        $objTrendding->subtitle = $subtitle;
                        $objTrendding->trendingimg = $uploadfile;
                        $objTrendding->statusid = 2;
                        $objTrendding->offer = $offer;
                        if ($objTrendding->save()) {
                            $arrReturn['status'] = TRUE;
                            $arrReturn['id'] = $objTrendding->id;
                            $arrReturn['c'] = $DataCount;
                            $arrReturn['msg'] = 'save successfully.';
                        }
//                        }
                    }
                }
            }
        } else if ($DataCount != 0) {
            $arrReturn['c'] = $DataCount;
            if ($request->isPost) {
                if (!empty($_FILES)) {
                    $uploaddir = 'resources/users/';
                    $image_name = md5(date('Ymdhis'));
                    $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                    $file = $_FILES["file"]['tmp_name'];
                    list($width, $height) = getimagesize($file);
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
//                        if (($width < "650" || $width > "650") || ($height < "280" || $height > "280")) {
//                            $arrReturn['error'] = ('error img size');
//                        } else {
                        $objTrendding = new Trendding();
                        $objTrendding->title = $title;
                        $objTrendding->subtitle = $subtitle;
                        $objTrendding->trendingimg = $uploadfile;
                        $objTrendding->statusid = 2;
                        $objTrendding->offer = $offer;
                        if ($objTrendding->save()) {
                            $arrReturn['status'] = TRUE;
                            $arrReturn['id'] = $objTrendding->id;
                            $arrReturn['c'] = $DataCount;
                            $arrReturn['msg'] = 'save successfully.';
                        }
//                        }
                    }
                }
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionSavetrendingproduct() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $basePath = Yii::$app->params['basePath'];
        $this->layout = "";
        $trenddingid = $request->get('trenddingid');
        $title = $request->get('title');
        $offer = $request->get('offer');
        $price = $request->get('price');
        $offerprice = $request->get('offerprice');
        $productstatusid = $request->get('productstatusid');
        $producttypeid = $request->get('producttypeid');
        $statusid = $request->get('statusid');
        if ($request->isPost) {
            if (!empty($_FILES)) {
                $uploaddir = 'resources/users/';
                $image_name = md5(date('Ymdhis'));
                $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                $file = $_FILES["file"]['tmp_name'];
                list($width, $height) = getimagesize($file);
                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
//                    if (($width < "255" || $width > "255") || ($height < "291" || $height > "291")) {
//                        $arrReturn['error'] = ('error img size');
//                    } else {
                        $objTrenddingproduct = new Trenddingproduct();
                        $objTrenddingproduct->trenddingid = $trenddingid;
                        $objTrenddingproduct->title = $title;
                        $objTrenddingproduct->offer = $offer;
                        $objTrenddingproduct->price = $price;
                        $objTrenddingproduct->offerprice = $offerprice;
                        $objTrenddingproduct->productstatusid = $productstatusid;
                        $objTrenddingproduct->producttypeid = $producttypeid;
                        $objTrenddingproduct->image = $uploadfile;
                        $objTrenddingproduct->statusid = $statusid;
                        if ($objTrenddingproduct->save()) {
                            $arrReturn['status'] = TRUE;
                            $arrReturn['id'] = $objTrenddingproduct->id;
                            $arrReturn['msg'] = 'save successfully.';
                        }
//                    }
                }
            }
        }
        echo json_encode($arrReturn);
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
                    $objShirtcategories = \app\models\Trenddingproduct::find()->where(['id' => $id])->One();
                    $objShirtcategories->title = $request->post('title');
                    $objShirtcategories->offer = $request->post('offer');
                    $objShirtcategories->price = $request->post('price');
                    $objShirtcategories->offerprice = $request->post('offerprice');
                    $objShirtcategories->productstatusid = $request->post('productstatusid');
                    $objShirtcategories->producttypeid = $request->post('producttypeid');
                    $objShirtcategories->statusid = $request->post('statusid');
                    if ($objShirtcategories->save()) {
                        $arrReturn['status'] = TRUE;
                        $arrReturn['id'] = $objShirtcategories->id;
                        $arrReturn['msg'] = 'save successfully.';
                    } else {
                        $arrReturn['orgerr'][] = $objShirtcategories->getErrors();
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

    public function actionGetofferprice1() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objTrenddingproduct = \app\models\Trenddingproduct::findOne(['id' => $id]);
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

    public function actionAlltreddingproduct() {
        $request = Yii::$app->request;
        $arrJSON = array();
        $arrTrendding = array();
        $connection = Yii::$app->db;
        $objTrendding = $connection->createCommand('Select c.id ,c.title,c.subtitle,c.offer,
            c.addeddate,s.name as stype  from `trendding` c  
            LEFT join status s on s.id = c.statusid
             ORDER BY `addeddate` DESC
                    ')->queryAll();

        foreach ($objTrendding AS $objrow) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['id'] = $objrow['id'];
            $arrTemp['title'] = $objrow['title'];
            $arrTemp['subtitle'] = $objrow['subtitle'];
            $arrTemp['offer'] = $objrow['offer'] . ' ' . '%';
            $arrTemp['stype'] = $objrow['stype'];
            $arrTemp['addeddate'] = date('d-m-Y', strtotime($objrow['addeddate']));

            $arrTrendding[] = $arrTemp;
        }
        $arrJSON['data'] = $arrTrendding;
        echo json_encode($arrJSON);
    }

    public function actionGetallproduct() {
        $arrJSON = array();
        $arrTrendding = array();
        $request = Yii::$app->request;
        $this->layout = "";
        $trenddingid = $request->get('trenddingid');
        $connection = Yii::$app->db;
        $Data = $connection->createCommand('Select t.id ,t.title,t.trenddingid ,t.offer,t.offerprice,t.addeddate,
                        t.productstatusid ,t.producttypeid ,t.price,t.image,t.statusid,
                        pt.name as ptype ,p.name as pstatus  from `trenddingproduct` t 
                        LEFT JOIN `productstatus` p on p.id = t.productstatusid
                        LEFT JOIN `producttype` pt on pt.id = t.producttypeid
                        where t.trenddingid  = ' . $trenddingid . ' ORDER BY addeddate DESC')->queryAll();
        foreach ($Data AS $objrow) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['id'] = $objrow['id'];
            $arrTemp['title'] = $objrow['title'];
            $arrTemp['price'] = $objrow['price'];
            $arrTemp['offer'] = $objrow['offer'];
            $arrTemp['pstatus'] = $objrow['pstatus'];
            $arrTemp['offerprice'] = $objrow['offerprice'];
            $arrTemp['ptype'] = $objrow['ptype'];
            $arrTemp['addeddate'] = date('d-m-Y', strtotime($objrow['addeddate']));

            $arrTrendding[] = $arrTemp;
        }
        $arrJSON['data'] = $arrTrendding;
        echo json_encode($arrJSON);
    }

    public function actionDeleteuser() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objTrendding = Trendding::find()->where(['id' => $id])->One();
                $objTrendding->id = $id;
                $objTrendding->delete();
                $arrReturn['id'] = $id;
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'Deleted successfully.';
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

}

// end of TrendingController.php

    