<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\Vender;
use common\model\form\VenderListForm;
use yii\validators\EmailValidator;
use umeworld\lib\PhoneValidator;

class VenderManageController extends MController{
	
    public function actionShowList(){
		$oVenderListForm = new VenderListForm();
		$aParams = Yii::$app->request->get();
		if($aParams && (!$oVenderListForm->load($aParams, '') || !$oVenderListForm->validate())){
			return new Response(current($oVenderListForm->getErrors())[0]);
		}
		$aList = $oVenderListForm->getList();
		$oPage = $oVenderListForm->getPageObject();
		
		return $this->render('show-list', [
			'aVenderList' => $aList,
			'oPage' => $oPage,
		]);
    }
	
    public function actionShowEdit(){
		$id = (int)Yii::$app->request->get('id');
		
		$aVender = [];
		$mVender = Vender::findOne($id);
		if($mVender){
			$aVender = $mVender->toArray();
		}
		return $this->render('show-edit', [
			'aVender' => $aVender
		]);
    }
	
	public function actionSave(){
		$id = (int)Yii::$app->request->post('id');
		$name = (string)Yii::$app->request->post('name');
		$userName = (string)Yii::$app->request->post('userName');
		$mobile = (string)Yii::$app->request->post('mobile');
		$email = (string)Yii::$app->request->post('email');
		$companyCode = (string)Yii::$app->request->post('companyCode');
		$password = (string)Yii::$app->request->post('password');
		if(!$userName){
			return new Response('请填写用户名', -1);
		}
		
		$mVender1 = null;
		$mVender2 = null;
		$mVender3 = null;
		if($userName){
			$mVender1 = Vender::findOne(['user_name' => $userName]);
		}
		if($mobile){
			$isMobile = (new PhoneValidator())->validate($mobile);
			if(!$isMobile){
				return new Response('手机格式不正确', -1);
			}
			$mVender2 = Vender::findOne(['mobile' => $mobile]);
		}
		if($email){
			$isEmail = (new EmailValidator())->validate($email);
			if(!$isEmail){
				return new Response('邮箱格式不正确', -1);
			}
			$mVender3 = Vender::findOne(['email' => $email]);
		}
		$isSuccess = false;
		if($id){
			if($mVender1 && $mVender1->id != $id){
				return new Response('该用户名已存在了', -1);
			}
			if($mVender2 && $mVender2->id != $id){
				return new Response('该手机已存在了', -1);
			}
			if($mVender3 && $mVender3->id != $id){
				return new Response('该邮箱已存在了', -1);
			}
			$mVender = Vender::findOne($id);
			if($mVender){
				$mVender->set('name', $name);
				$mVender->set('user_name', $userName);
				$mVender->set('mobile', $mobile);
				$mVender->set('email', $email);
				$mVender->set('company_code', $companyCode);
				if($password){
					$mVender->set('password', Vender::encryPassword($password));
				}
				$isSuccess = $mVender->save();
			}
		}else{
			if($mVender1){
				return new Response('该用户名已被注册', -1);
			}
			if($mVender2){
				return new Response('该手机已被注册', -1);
			}
			if($mVender3){
				return new Response('该邮箱已被注册', -1);
			}
			$isSuccess = Vender::initData([
				'name' => $name,
				'user_name' => $userName,
				'mobile' => $mobile,
				'email' => $email,
				'company_code' => $companyCode,
				'password' => Vender::encryPassword($password),
			]);
		}
		
		if(!$isSuccess){
			return new Response('保存失败', 0);
		}
		return new Response('保存成功', 1);
	}
	
	public function actionDelete(){
		$id = (int)Yii::$app->request->post('id');
		
		$mVender = Vender::findOne($id);
		if(!$mVender){
			return new Response('找不到商家信息', 0);
		}
		$isSuccess = $mVender->delete();
		if(!$isSuccess){
			return new Response('删除失败', 0);
		}
		return new Response('删除成功', 1);
	}
}
