<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Userroles;
use app\models\Status;
use app\models\Organisation;

class DealerController extends Controller {

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

    public function actionError() {
        return $this->render('error', [
        ]);
    }
    public function actionAlldealers() {
        $request = Yii::$app->request;
        $arrJSON = array();
        $arrTrendding = array();
        $connection = Yii::$app->db;
        $objTrendding = $connection->createCommand('Select *  from dealers  
                    ')->queryAll();

        foreach ($objTrendding AS $objrow) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['id'] = $objrow['id'];
            $arrTemp['name'] = $objrow['name'];
            $arrTemp['phone'] = $objrow['phone'];
            $arrTemp['email'] = $objrow['email'];
            $arrTemp['organisation'] = $objrow['organisation'];
            $arrTemp['addeddate'] = date('d-m-Y', strtotime($objrow['addeddate']));

            $arrTrendding[] = $arrTemp;
        }
        $arrJSON['data'] = $arrTrendding;
        echo json_encode($arrJSON);
    }
}

// end of DashboardController.php
