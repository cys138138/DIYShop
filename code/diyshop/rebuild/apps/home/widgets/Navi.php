<?php
namespace home\widgets;

use Yii;
use yii\base\Widget;

class Navi extends Widget{
	public function run(){
		$aUser = [];
		$role = '';
		$mManager = Yii::$app->manager->getIdentity();
		if($mManager){
			$aUser = $mManager->toArray();
			$role = 'manager';
		}
		$mVender = Yii::$app->vender->getIdentity();
		if($mVender){
			$aUser = $mVender->toArray();
			$role = 'vender';
		}
		$aMenuConfig = Yii::$app->params['menu_config'];
		return $this->render('navi', [
			'aUser' => $aUser,
			'role' => $role,
			'aMenuConfig' => $aMenuConfig,
		]);
	}
}