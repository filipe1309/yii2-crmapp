<?php

namespace app\models\user;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use app\components\MyBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 */
class UserRecord extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'auth_key'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
    
        public function behaviors()
    {
        return [
            // anonymous behavior, behavior class name only
            //MyBehavior::className(),

            'myBehavior' => MyBehavior::className(),

            /*// named behavior, behavior class name only
            'myBehavior2' => MyBehavior::className(),

            // anonymous behavior, configuration array
            [
                'class' => MyBehavior::className(),
                'prop1' => 'value1',
                'prop2' => 'value2',
            ],

            // named behavior, configuration array
            'myBehavior4' => [
                'class' => MyBehavior::className(),
                'prop1' => 'value1',
                'prop2' => 'value2',
            ]*/
        ];
    }
    
    public function beforeSave($insert)
    {
        $return = parent::beforeSave($insert);
        
        if ($this->isAttributeChanged('password'))
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        
        if ($this->isNewRecord)
            $this->auth_key = Yii::$app->security->generateRandomKey($length = 255);
        
        return $return;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    
    // Required for "Remember me" functionality
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    // Required for "Remember me" functionality
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    // Useful in case of authorization like OAuth2 or OpenID
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // stub
        throw new NotSupportedException(
            'You can only login by username/password pair for now'
        );
    }
}
