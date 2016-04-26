<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;

class ManagerController extends MController{

    public function actionIndex(){
        return $this->render('index');
    }

}
