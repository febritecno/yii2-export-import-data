<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Security;


class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $ulang_password ;
    
    public static function tableName()
    {
            return 'User';
    }
     

    public function rules()
     {
          return [
                 [['username','password'],'required'],
                 [['ulang_password'],'required'],
                 ['ulang_password', 'compare', 'compareAttribute' => 'password']
          ];
     }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
         return static::findOne(['access_token'=>$token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */

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
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    
    // metode untuk login berdasarkan username dan password
    public static function findByUsername($username)
    {
       return static::findOne(['username' => $username]);
    }

     public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
    

      public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }

            if (isset($this->password)){
                $this->password= md5($this->password);
                
            }
            return parent::beforeSave($insert);
        }
        return false;
    }
}
