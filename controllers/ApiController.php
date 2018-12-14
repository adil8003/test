<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Banner;
use app\models\Subbanner;
use app\models\Status;
use app\models\Newarrivalproduct;
use app\models\Trenddingproduct;
use app\models\Trendding;

class ApiController extends Controller {

    public $enableCsrfValidation = false;
    public $user_id = '';

    public function init() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
        $this->layout = "";
    }

    public function actionIndex($callback = null) {
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

    public function actionGetallnewarrivals($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $objNewarrivalproduct = \app\models\Newarrivalproduct::find()->where(['statusid' => 2])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['data'] = $objNewarrivalproduct;
        if (!$arrReturn['data']) {
            $arrReturn1 = array();
            $arrReturn['data'][] = $arrReturn1;
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

    public function actionGettrenddingthreeimg($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $objTrendding = \app\models\Trendding::find()->where(['statusid' => 2])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['data'] = $objTrendding;
        if (!$arrReturn['data']) {
            $arrReturn1 = array();
            $arrReturn['data'][] = $arrReturn1;
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

    public function actionGetbannerimage($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $DefaultBanner = 'C:\wamp64\www\festone//resources/users/no_image.jpg';
        $objBanner = \app\models\Banner::find()->where(['statusid' => 2])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['banner'] = $objBanner;
        if (!$arrReturn['banner']) {
            $arrReturn1 = array();
            $arrReturn1['path'] = '/resources/users/no-image.jpg';
            $arrReturn['banner'][] = $arrReturn1;
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

    public function actionGetsubbanner($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $objSubbanner = \app\models\Subbanner::find()->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['subbanner'] = $objSubbanner;
        if (!$arrReturn['subbanner']) {
            $arrReturn1 = array();
            $arrReturn1['path'] = '/resources/users/no-image.jpg';
            $arrReturn['subbanner'][] = $arrReturn1;
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

    public function actionGetalloffer1product($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objData = \app\models\Trenddingproduct::find()->where(['trenddingid' => $id])->andWhere(['statusid' => 2])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['data'] = $objData;
        if (!$arrReturn['data']) {
            $arrReturn1 = array();
            $arrReturn['data'][] = $arrReturn1;
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

    public function actionGetallimagesofshirt($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $connection = Yii::$app->db;
        $objData = $connection->createCommand('Select s.id ,s.title,s.shirtsid ,s.offer,s.offerprice,s.addeddate,
                        s.productstatusid ,s.producttypeid ,s.price,sm.images,sm.type,sm.imgtype,sm.id as imgid, 
                        pt.name as ptype ,p.name as pstatus, st.name as sstatus  from `shirtcategories` s 
                        LEFT JOIN `productstatus` p on p.id = s.productstatusid
                        LEFT JOIN `producttype` pt on pt.id = s.producttypeid
                        LEFT JOIN `status` st on pt.id = s.statusid
                          LEFT JOIN `shirtimages` sm on s.id = sm.shirtcategoriesid
                        where sm.shirtcategoriesid  = ' . $id . ' ORDER BY addeddate DESC')->queryAll();
        $arrReturn['status'] = TRUE;
        $arrReturn['data'] = $objData;
        if (!$arrReturn['data']) {
            $arrReturn1 = array();
            $arrReturn['data'][] = $arrReturn1;
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
    public function actionFeaturearrival($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $connection = Yii::$app->db;
        $objData = $connection->createCommand('Select * from newarrivalproduct where statusid = ' . 2 . '  ORDER BY `addeddate` DESC limit 4')->queryAll();
        $arrReturn['status'] = TRUE;
        $arrReturn['data'] = $objData;
        if (!$arrReturn['data']) {
            $arrReturn1 = array();
            $arrReturn['data'][] = $arrReturn1;
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
     public function actionLinkviewimage($callback = null) {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objShirtimages = \app\models\Shirtimages::find()->where(['id' => $id])->One();
        $file = $objShirtimages->images;

        header('Content-type: resources/jpg');
        readfile($file);
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

    public function actionGetallcasualproduct($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objData = \app\models\Shirtcategories::find()->where(['shirtsid' => $id])->andWhere(['statusid' => 2])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['data'] = $objData;
        if (!$arrReturn['data']) {
            $arrReturn1 = array();
            $arrReturn['data'][] = $arrReturn1;
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

    public function actionGetalloccasionalproduct($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objData = \app\models\Shirtcategories::find()->where(['shirtsid' => $id])->andWhere(['statusid' => 2])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['data'] = $objData;
        if (!$arrReturn['data']) {
            $arrReturn1 = array();
            $arrReturn['data'][] = $arrReturn1;
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

    public function actionGetallformalproduct($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objData = \app\models\Shirtcategories::find()->where(['shirtsid' => $id])->andWhere(['statusid' => 2])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['data'] = $objData;
        if (!$arrReturn['data']) {
            $arrReturn1 = array();
            $arrReturn['data'][] = $arrReturn1;
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

    public function actionGetallprintedproduct($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objData = \app\models\Shirtcategories::find()->where(['shirtsid' => $id])->andWhere(['statusid' => 2])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['data'] = $objData;
        if (!$arrReturn['data']) {
            $arrReturn1 = array();
            $arrReturn['data'][] = $arrReturn1;
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

    public function actionGetalllinendproduct($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objData = \app\models\Shirtcategories::find()->where(['shirtsid' => $id])->andWhere(['statusid' => 2])->all();
        $arrReturn['status'] = TRUE;
        $arrReturn['data'] = $objData;
        if (!$arrReturn['data']) {
            $arrReturn1 = array();
            $arrReturn['data'][] = $arrReturn1;
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

    public function actionLinkproductimage($callback = null) {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objBanner = Banner::find()->where(['id' => $id])->One();
        $file = $objBanner->bannerimg;

        header('Content-type: resources/jpg');
        readfile($file);
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

    public function actionLinknewproduct($callback = null) {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $objNewarrivalproduct = Newarrivalproduct::find()->where(['id' => $id])->One();
        $file = $objNewarrivalproduct->productimg;

        header('Content-type: resources/jpg');
        readfile($file);
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

    public function actionLinkbusbannerimage($callback = null) {
        $request = Yii::$app->request;
        $id = $request->get('id');

        $objSubbanner = Subbanner::find()->where(['id' => $id])->One();
        $file = $objSubbanner->subimg;

        header('Content-type: resources/jpg');
        readfile($file);
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

    public function actionLinktrendingfirstimage($callback = null) {
        $request = Yii::$app->request;
        $id = $request->get('id');

        $objTrenddingFirstimg = \app\models\Trendding::findOne($id);
        $file = $objTrenddingFirstimg->trendingimg;

        header('Content-type: resources/jpg');
        readfile($file);
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

    public function actionLinktrendingoffer5($callback = null) {
        $request = Yii::$app->request;
        $id = $request->get('id');

        $objTrenddingFourthimg = \app\models\Trendding::find()->where(['id' => 4])->One();
//        echo "<pre>";
//        print_r($objTrenddingFirstimg);
//        echo "<pre>";die;
        $file = $objTrenddingFourthimg->trendingimg;

        header('Content-type: resources/jpg');
        readfile($file);
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

    public function actionLinkofferimg($callback = null) {
        $request = Yii::$app->request;
        $id = $request->get('id');

        $objTrenddingproduct = \app\models\Trenddingproduct::find()->where(['id' => $id])->One();
        $file = $objTrenddingproduct->image;

        header('Content-type: resources/jpg');
        readfile($file);
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

    public function actionLinkshirttypeimg($callback = null) {
        $request = Yii::$app->request;
        $id = $request->get('id');

        $objShirtcategories = \app\models\Shirtcategories::find()->where(['id' => $id])->One();
        $file = $objShirtcategories->images;

        header('Content-type: resources/jpg');
        readfile($file);
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

    public function actionSavedealer($callback = null) {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        $objDealers = new \app\models\Dealers();
        $objDealers->name = $request->get('name');
        $objDealers->email = $request->get('email');
        $objDealers->phone = $request->get('phone');
        $objDealers->address = $request->get('address');
        $objDealers->organisation = $request->get('organisation');
        if ($objDealers->save()) {
            $arrReturn['status'] = TRUE;
            $arrReturn['id'] = $objDealers->id;
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
