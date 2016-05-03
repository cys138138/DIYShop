<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\Setting;
use common\model\Dress;

class GuessLikeController extends MController{
	const DATA_SETTING_KEY = 'guess_like_config';
	
	private function _getGuessLikeConfig(){
		return json_decode(Setting::getSetting(self::DATA_SETTING_KEY), true);
	}
	
	private function _setGuessLikeConfig($aData){
		return Setting::setSetting(self::DATA_SETTING_KEY, json_encode($aData));
	}

    public function actionShowList(){
		$aList = $this->_getGuessLikeConfig();
		if($aList){
			foreach($aList as $key => $aValue){
				$mDress = Dress::findOne($aValue['dress_id']);
				if($mDress){
					$aList[$key]['name'] = $mDress->name;
					if(isset($mDress->pics[$aValue['pic_index']])){
						$aList[$key]['pic'] = $mDress->pics[$aValue['pic_index']];
					}else{
						$aList[$key]['pic'] = '';
					}
				}
			}
		}else{
			$aList = [];
		}
        return $this->render('list', ['aList' => $aList]);
    }

	public function actionShowSetting(){
		return $this->render('setting');
	}
	
	public function actionSearchDress(){
		$venderId = (int)Yii::$app->request->post('venderId');
		$dressId = (int)Yii::$app->request->post('dressId');
		
		if(!$venderId){
			return new Response('请输入商家编号', -1);
		}
		if(!$dressId){
			return new Response('请输入服饰编号', -1);
		}
		
		$mDress = Dress::findOne([
			'id' => $dressId,
			'vender_id' => $venderId,
		]);
		
		if(!$mDress){
			return new Response('服饰不存在！', -1);
		}
		
		return new Response('服饰信息', 1, $mDress->toArray());
	}
	
	public function actionSaveSetting(){
		$dressId = (int)Yii::$app->request->post('dressId');
		$picIndex = (int)Yii::$app->request->post('picIndex');
		
		if(!$dressId){
			return new Response('服饰不存在！', -1);
		}
		$mDress = Dress::findOne($dressId);
		if(!$mDress){
			return new Response('服饰不存在！', -1);
		}
		
		$aList = $this->_getGuessLikeConfig();
		$isFind = false;
		if($aList){
			foreach($aList as $key => $aValue){
				if($aValue['dress_id'] == $dressId){
					$aList[$key]['pic_index'] = $picIndex;
					$isFind = true;
				}
			}
		}else{
			$aList = [];
		}
		if(!$isFind){
			array_push($aList, [
				'dress_id' => $dressId,
				'pic_index' => $picIndex
			]);
		}
		
		$this->_setGuessLikeConfig($aList);
		
		return new Response('保存成功', 1);
	}
	
	public function actionDelete(){
		$dressId = (int)Yii::$app->request->post('dressId');
		$aList = $this->_getGuessLikeConfig();
		$aData = [];
		if($aList){
			foreach($aList as $key => $aValue){
				if($aValue['dress_id'] != $dressId){
					array_push($aData, $aValue);
				}
			}
		}
		$this->_setGuessLikeConfig($aData);
		
		return new Response('删除成功', 1);
	}
}
