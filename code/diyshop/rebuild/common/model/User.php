<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\validators\EmailValidator;
use umeworld\lib\PhoneValidator;

class User extends \common\lib\DbOrmModel implements IdentityInterface{
	const SEX_BOY = 1;
	const SEX_GIRL = 2;
	
	public static function tableName(){
		return Yii::$app->db->parseTable('_@user');
	}
	
	public function allow($permissionName){
		return true;
	}
	
	  /**
     * @inheritdoc
     */
    public static function findIdentity($id){
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null){
        throw new NotSupportedException('根据令牌找用户 的方法未实现');
    }

    /**
     * 根据密码重置口令获取学生模型
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token){
        if (!static::isPasswordResetTokenValid($token)) {
            return false;
        }
		/*
        return static::findOne([
            'password_reset_token' => $token,
        ]);
		*/
    }

    /**
     * 验证重置密码口令是否过期
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token){
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey(){
        return $this->_authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey){
        return $this->getAuthKey() === $authKey;
    }
	
	public static function getList($aCondition = [], $aControl = []){
		$aWhere = self::_parseWhereCondition($aCondition);
		$oQuery = new Query();
		$oQuery->from(static::tableName())->where($aWhere);
		if(isset($aControl['order_by'])){
			$oQuery->orderBy($aControl['order_by']);
		}
		if(isset($aControl['page']) && isset($aControl['page_size'])){
			$offset = ($aControl['page'] - 1) * $aControl['page_size'];
			$oQuery->offset($offset)->limit($aControl['page_size']);
		}
		$aList = $oQuery->all();
		if(!$aList){
			return [];
		}
		if(isset($aControl['width_total_consumption']) && $aControl['width_total_consumption']){
			$aUserIds = ArrayHelper::getColumn($aList, 'id');
			$sql = 'SELECT `user_id`,SUM(`total_price`) AS `total_consumption` FROM `order` WHERE `order_type`=0 AND `user_id` IN (3, 9, 13) AND `pay_time`>0 GROUP BY `user_id`';
			$aTotalConsumptionList = Yii::$app->db->createCommand($sql)->queryAll();
			foreach($aList as $key => $aValue){
				$aList[$key]['total_consumption'] = 0;
				foreach($aTotalConsumptionList as $k => $v){
					if($v['user_id'] == $aValue['id']){
						$aList[$key]['total_consumption'] = $v['total_consumption'];
					}
				}
			}
		}
		
		return $aList;
	}
	
	public static function getCount($aCondition = []){
		$aWhere = self::_parseWhereCondition($aCondition);
		return (new Query())->from(self::tableName())->where($aWhere)->count();
	}
	
	private static function _parseWhereCondition($aCondition = []){
		$aWhere = ['and'];
		if(isset($aCondition['id'])){
			$aWhere[] = ['id' => $aCondition['id']];
		}
		if(isset($aCondition['mobile_like']) && $aCondition['mobile_like']){
			$aWhere[] = ['like', 'mobile', $aCondition['mobile_like']];
		}

		return $aWhere;
	}
	
	public static function encryPassword($password){
		return md5($password);
	}
	
	public static function getOneByAccountAndPassword($account, $password){
		if(!$account){
			return false;
		}
		if(!$password){
			return false;
		}
		
		$isEmail = (new EmailValidator())->validate($account);
		$isMobile = (new PhoneValidator())->validate($account);
		$mUser = null;
		if($isEmail){
			$mUser = self::findOne([
				'email' => $account,
				'password' => self::encryPassword($password)
			]);
		}
		if($isMobile){
			$mUser = self::findOne([
				'mobile' => $account,
				'password' => self::encryPassword($password)
			]);
		}
		if(!$isEmail && !$isMobile){
			$mUser = self::findOne([
				'user_name' => $account,
				'password' => self::encryPassword($password)
			]);
		}
		return $mUser;
	}
	
	public static function registerUser($aData){
		if(isset($aData['password']) && $aData['password']){
			$aData['password'] = self::encryPassword($aData['password']);
		}
		(new Query())->createCommand()->insert(static::tableName(), $aData)->execute();
		return self::findOne(Yii::$app->db->getLastInsertID());
	}

}