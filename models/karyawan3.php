<?php



namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Security;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;


class User extends ActiveRecord implements IdentityInterface
{
    

    
    public static function tableName()
    {
         return '{{%User}}';
    }


    public function rules()
    {
        return [['username','password'],'required'];
    }


    public static function findIdentity($id) {
         return static::findOne($id);
    }

    public static function findByUsername($username) {
         return static::findOne(['username'=> $username]);
    }
    




    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
    

     public static function findIdentityByAccessToken($token,$type = null)
     {
           return static::findOne(['access_token' => $token]);
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
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
