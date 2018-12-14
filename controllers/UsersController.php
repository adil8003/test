<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Status;
use app\models\Userroles;
use app\models\Organisation;
use app\models\Courses;

class UsersController extends Controller {

    public $enableCsrfValidation = false;
    public $base_path = '';
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

    public function actionEdituser() {
        return $this->render('edituser', [
        ]);
    }

    public function actionError() {
        return $this->render('error', [
        ]);
    }


    public function actionAllusers() {
        $arrJSON = array();
        $arrOrganisation = array();
        $this->layout = "";
        $connection = Yii::$app->db;
        $objOrganisationusers = $connection->createCommand('Select u.id,ro.name,r.org_id,a.orgname,st.name, u.fullname,u.email,u.phone,u.reg_date from `user` u LEFT join `userroles` r on u.id = r.user_id join `organisation` a on a.id = r.org_id join `roles` ro on ro.id = u.role_id join `status` st on st.id = u.status_id where u.id != ' . Yii::$app->session['userid'])->queryAll();
        foreach ($objOrganisationusers AS $objrow) {
            $arrTemp = array();
            $arrTemp['id'] = $objrow['id'];
            $arrTemp['fullname'] = $objrow['fullname'];
            $arrTemp['email'] = $objrow['email'];
            $arrTemp['phone'] = $objrow['phone'];
            $arrTemp['status'] = $objrow['name'];
            $arrTemp['orgname'] = $objrow['orgname'];
            $arrTemp['org_id'] = $objrow['org_id'];
            $objRole = User::findOne(($objrow['id']));
            $arrTemp['roles'] = $objRole->role->name;
            $arrTemp['reg_date'] = date('M-d,Y', strtotime($objrow['reg_date']));
            $arrOrganisation[] = $arrTemp;
        }
        $arrJSON['data'] = $arrOrganisation;
        echo json_encode($arrJSON);
    }

    public function actionGetuserdetailbyid() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $this->layout = "";
        $request = Yii::$app->request;
        $id = $request->post('id');
        $objData = User:: find()->where(['id' => $id])->one();
        if ($objData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['fullname'] = $objData->fullname;
            $arrReturn['username'] = $objData->username;
            $arrReturn['email'] = $objData->email;
            $arrReturn['phone'] = $objData->phone;
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
                $objUser = User::findOne(['id' => $id]);
                if (!$objUser) {
                    $objUser = new User();
                    $objUser->id = $id;
                }
                $objUser = User::find()->where(['id' => $id])->One();
                $objUser->fullname = $request->post('fullname');
                $objUser->username = $request->post('username');
                $objUser->email = $request->post('email');
                $objUser->phone = $request->post('phone');
                if ($objUser->save()) {
                    $arrReturn['status'] = TRUE;
                    $arrReturn['id'] = $objUser->id;
                }
            }
            echo json_encode($arrReturn);
        }
    }

    public function actionDeleteuser() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $request = Yii::$app->request;
        $this->layout = "";
        if ($request->isPost) {
            $id = $request->post('id');
            if ($id != 0) {
                $objUser = User::findOne(['id' => $id]);
                $userid = ($request->post('status_id') == 'Active') ? 2 : 1;
                $objUser->status_id = $userid;
                $objUser->save();
                $arrReturn['$userid'] = $userid;
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'Deleted successfully.';
            } else {
                $arrReturn['msg'] = 'Please try again';
            }
        }
        echo json_encode($arrReturn);
    }

}

// end of UsersController.php
