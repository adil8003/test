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
use app\models\Shirts;
use app\models\Status;
use app\models\Shirttype;
use app\models\Formalshirt;
use app\models\Occasionshirt;
use app\models\Linenshirt;
use app\models\Casualshirt;
use app\models\Printedshirt;
use app\models\Shirtimages;

class DressController extends Controller {

    public $enableCsrfValidation = false;
    public $userid = '';

    public function init() {
        if (Yii::$app->session['isLoggedIn'] != true) {
            return $this->redirect('index.php?r=site/login');
        }
        $this->layout = "dashboard";
    }

    public function actionIndex() {
        $objShirttype = \app\models\Shirttype::find()->all();
        return $this->render('index', [
                    'objShirttype' => $objShirttype,
        ]);
    }

    public function actionAdd() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objShirttype = \app\models\Shirttype::find()->all();
        $objShirts = \app\models\Shirts::find()->where(['shirttypeid' => $id])->One();
        $objProductstatus = \app\models\Productstatus::find()->all();
        $objProducttype = \app\models\Producttype::find()->all();
        $objStatus = Status::find()->all();
        return $this->render('add', [
                    'objProductstatus' => $objProductstatus,
                    'objProducttype' => $objProducttype,
                    'objShirttype' => $objShirttype,
                    'objShirts' => $objShirts,
                    'objStatus' => $objStatus
        ]);
    }

    public function actionEdit() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $connection = Yii::$app->db;
        $objShirttype = \app\models\Shirttype::find()->all();
        $objShirtcategories = \app\models\Shirtcategories::find()->where(['id' => $id])->One();
        $objProductstatus = \app\models\Productstatus::find()->all();
        $objProducttype = \app\models\Producttype::find()->all();
        $objStatus = Status::find()->all();
        return $this->render('edit', [
                    'objProductstatus' => $objProductstatus,
                    'objProducttype' => $objProducttype,
                    'objShirttype' => $objShirttype,
                    'objShirtcategories' => $objShirtcategories,
                    'objStatus' => $objStatus
        ]);
    }

    public function actionError() {
        return $this->render('error', [
        ]);
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
                                    $objShirtimages->shirtcategoriesid = $shirtcategoriesid;
                                    $objShirtimages->type = 1;
                                    $objShirtimages->imgtype = 'shirtcat';
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
                    $objShirtcategories = \app\models\Shirtcategories::find()->where(['id' => $id])->One();
                    $objShirtcategories->shirtsid = $request->post('id');
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
                       where s.shirtcategoriesid = ' . $id . '  ORDER BY `addeddate` DESC ')->queryAll();
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

    public function actionGetofferprice1() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objTrendding = \app\models\Shirtcategories::findOne(['id' => $id]);
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

    public function actionLinkshirtimage() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objShirtimages = \app\models\Shirtimages::find()->where(['id' => $id])->one();
        $file = $objShirtimages->images;
        header('Content-type: resources/png');
        readfile($file);
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
                $objShirts = \app\models\Shirtcategories::findOne(['id' => $id]);
                $objShirts->delete();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'Deleted successfully.';
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionSaveshirttype() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $shirttypeid = $request->post('shirttypeid');
        $objShirts = Shirts::findOne(['shirttypeid' => $shirttypeid]);
        $Count = count($objShirts);
        if ($Count === 0) {
            if ($request->isPost) {
                $objShirts = new \app\models\Shirts();
                $objShirts->shirttypeid = $request->post('shirttypeid');
                $objShirts->qty = $request->post('qty');
                $objShirts->offer = $request->post('offer');
                if ($objShirts->save()) {
                    $arrReturn['status'] = TRUE;
                    $arrReturn['id'] = $objShirts->id;
                    $arrReturn['msg'] = 'save successfully.';
                }
            }
        } else {
            $arrReturn['msg'] = 'You have already added this shirt try differnt.';
        }
        echo json_encode($arrReturn);
    }

    public function actionUpdateshirttype() {
        $transaction = Yii::$app->db->beginTransaction();
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            try {
                $id = $request->post('shirttypeid');
                if ($id != 0) {
                    $objShirts = Shirts::find()->where(['shirttypeid' => $id])->One();
                    $objShirts->qty = $request->post('qty');
                    $objShirts->offer = $request->post('offer');
                    if ($objShirts->save()) {
                        $arrReturn['status'] = TRUE;
                        $arrReturn['id'] = $objShirts->id;
                        $arrReturn['msg'] = 'update successfully.';
                    } else {
                        $arrReturn['orgerr'][] = $objShirts->getErrors();
                    }
                } $transaction->commit();
                yii::info('all modal saved');
            } catch (Exception $ex) {
                $arrReturn['curexp'] = $e->getMessage();
                $transaction->rollBack();
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionLinkproductimage() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objShirtcategories = \app\models\Shirtcategories::findOne($id);
        $file = $objShirtcategories->images;

        header('Content-type: resources/jpg');
        readfile($file);
    }

    public function actionGetallproduct() {
        $arrJSON = array();
        $arrTrendding = array();
        $request = Yii::$app->request;
        $this->layout = "";
        $shirttypeid = $request->get('shirtsid');
        $connection = Yii::$app->db;
        $Data = $connection->createCommand('Select s.id ,s.title,s.shirtsid ,s.offer,s.offerprice,s.addeddate,
                        s.productstatusid ,s.producttypeid ,s.price,s.images,
                        pt.name as ptype ,p.name as pstatus, st.name as sstatus  from `shirtcategories` s 
                        LEFT JOIN `productstatus` p on p.id = s.productstatusid
                        LEFT JOIN `producttype` pt on pt.id = s.producttypeid
                        LEFT JOIN `status` st on pt.id = s.statusid
                        where s.shirtsid  = ' . $shirttypeid . ' ORDER BY addeddate DESC')->queryAll();
        foreach ($Data AS $objrow) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['id'] = $objrow['id'];
            $arrTemp['title'] = $objrow['title'];
            $arrTemp['price'] = $objrow['price'];
            $arrTemp['offer'] = $objrow['offer'];
            $arrTemp['pstatus'] = $objrow['pstatus'];
            $arrTemp['sstatus'] = $objrow['sstatus'];
            $arrTemp['offerprice'] = $objrow['offerprice'];
            $arrTemp['ptype'] = $objrow['ptype'];
            $arrTemp['addeddate'] = date('d-m-Y', strtotime($objrow['addeddate']));

            $arrTrendding[] = $arrTemp;
        }
        $arrJSON['data'] = $arrTrendding;
        echo json_encode($arrJSON);
    }

    public function actionGetofferprice() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objShirts = Shirts::findOne(['shirttypeid' => $id]);
                $Offer = $objShirts->offer;
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

    public function actionSaveshirtproduct() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $basePath = Yii::$app->params['basePath'];
        $this->layout = "";

        $shirttypeid = $request->get('shirtsid');
        $title = $request->get('title');
        $offer = $request->get('offer');
        $price = $request->get('price');
        $offerprice = $request->get('offerprice');
        $productstatusid = $request->get('productstatusid');
        $producttypeid = $request->get('producttypeid');
        $statusid = $request->get('statusid');
        if ($request->isPost) {
            if (!empty($_FILES)) {
                $uploaddir = 'resources/shirts/';
                $image_name = md5(date('Ymdhis'));
                $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
                $file = $_FILES["file"]['tmp_name'];
                list($width, $height) = getimagesize($file);
                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
//                    if (($width < "255" || $width > "2555") || ($height < "291" || $height > "291")) {
//                        $arrReturn['error'] = ('error img size');
//                    } else {
                    $objShirtcategories = new \app\models\Shirtcategories();
                    $objShirtcategories->shirtsid = $shirttypeid;
                    $objShirtcategories->title = $title;
                    $objShirtcategories->offer = $offer;
                    $objShirtcategories->price = $price;
                    $objShirtcategories->offerprice = $offerprice;
                    $objShirtcategories->productstatusid = $productstatusid;
                    $objShirtcategories->producttypeid = $producttypeid;
                    $objShirtcategories->images = $uploadfile;
                    $objShirtcategories->statusid = $statusid;
                    if ($objShirtcategories->save()) {
                        $arrReturn['status'] = TRUE;
                        $arrReturn['id'] = $objShirtcategories->id;
                        $arrReturn['msg'] = 'save successfully.';
                    }
//                    }
                }
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionAddgtypeofdress() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $objShirttype = new \app\models\Shirttype();
            $objShirttype->name = $request->post('name');
            if ($objShirttype->save()) {
                $arrReturn['status'] = TRUE;
                $arrReturn['id'] = $objShirttype->id;
                $arrReturn['msg'] = 'save successfully.';
            }
        }
        echo json_encode($arrReturn);
    }

    public function actionAllshirtstype() {
        $arrJSON = array();
        $arrShirts = array();
        $connection = Yii::$app->db;
        $objData = $connection->createCommand('Select s.id,s.shirttypeid, s.qty , s.offer ,s.addeddate,st.name as stype  from shirts s
            LEFT Join shirttype st on st.id = s.shirttypeid
                         ORDER BY `addeddate` DESC ')->queryAll();
        foreach ($objData AS $objrow) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['id'] = $objrow['id'];
            $arrTemp['shirttypeid'] = $objrow['shirttypeid'];
            $arrTemp['stype'] = $objrow['stype'];
            $arrTemp['offer'] = $objrow['offer'];
            $arrTemp['qty'] = $objrow['qty'];
            $arrTemp['addeddate'] = date('d-m-Y', strtotime($objrow['addeddate']));
            $arrShirts[] = $arrTemp;
        }
        $arrJSON['data'] = $arrShirts;
        echo json_encode($arrJSON);
    }
    public function actionGetdresstype() {
        $arrJSON = array();
        $arrShirts = array();
        $objShirttype = \app\models\Shirttype::find()->all();
        foreach ($objShirttype AS $objrow) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['id'] = $objrow['id'];
            $arrTemp['name'] = $objrow['name'];
            $arrShirts[] = $arrTemp;
        }
        $arrJSON['data'] = $arrShirts;
        echo json_encode($arrJSON);
    }

//    public function actionUploadimgs() {
//        $arrReturn = array();
//        $arrReturn['status'] = FALSE;
//        $basePath = Yii::$app->params['basePath'];
////        $uploadDir = 'uploads';
////            $uploaddir = 'resources/shirts/';
////if (!empty($_FILES)) {
//// $tmpFile = $_FILES['file']['tmp_name'];
//// $filename = $uploadDir.'/'.time().'-'. $_FILES['file']['name'];
//// move_uploaded_file($tmpFile,$filename);
////}
//        if (!empty($_FILES)) {
////            echo "<pre>";
////            print_r($_FILES);
////            echo "</pre>";die;
//            $uploaddir = 'resources/shirts/';
//            $image_name = md5(date('Ymdhis'));
//            $uploadfile = $basePath . $uploaddir . $image_name . ".jpg";
//            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
//                $request = Yii::$app->request;
//                $id = $request->post('shirtcatid');
//                $objTrendding = \app\models\Shirtcategories::find()->where(['id' => 1])->one();
//                $objTrendding->images = $uploadfile;
//                $objTrendding->save();
//                $arrReturn['status'] = TRUE;
//            } else {
//                $arrReturn['msg'] = 'Try again.';
//            }
//        }
//        echo json_encode($arrReturn);
//    }
}

// end of ShirtsController.php
