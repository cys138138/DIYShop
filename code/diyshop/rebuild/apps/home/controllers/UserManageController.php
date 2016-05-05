<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\User;
use common\model\form\UserListForm;
use yii\validators\EmailValidator;
use umeworld\lib\PhoneValidator;

class UserManageController extends MController{
	
    public function actionShowList(){
		$oUserListForm = new UserListForm();
		$aParams = Yii::$app->request->get();
		if($aParams && (!$oUserListForm->load($aParams, '') || !$oUserListForm->validate())){
			return new Response(current($oUserListForm->getErrors())[0]);
		}
		$aList = $oUserListForm->getList();
		$oPage = $oUserListForm->getPageObject();
		
		return $this->render('show-list', [
			'userId' => $oUserListForm->userId,
			'aUserList' => $aList,
			'oPage' => $oPage,
		]);
    }
	
	public function actionDelete(){
		$id = (int)Yii::$app->request->post('id');
		
		$mUser = User::findOne($id);
		if(!$mUser){
			return new Response('找不到用户信息', 0);
		}
		$isSuccess = $mUser->delete();
		if(!$isSuccess){
			return new Response('删除失败', 0);
		}
		return new Response('删除成功', 1);
	}
}
