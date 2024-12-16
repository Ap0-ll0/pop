<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $age
 * @property string $gender
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property int $role
 * @property string $username
 *
 * @property ResumPols[] $resumPols
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'age', 'gender', 'email', 'phone', 'password', 'username', 'role'], 'required','on' => self::SCENARIO_DEFAULT],
            ['username', 'match', 'pattern' => '/^[a-z]+$/iu', 'message'=>'Только латиница'],
            ['email', 'email','on' => self::SCENARIO_UPDATE_EMAIL],
            [['phone'], 'required','on' => self::SCENARIO_UPDATE],
            ['password', 'match', 'pattern' => '/^(?=.*[A-Z])(?=.*[\d])(?=.*[a-z])(?=.*[\W])[a-zA-Z\d\W]{6,20}/iu', 'message'=>'Латиница, 6+ символов, 1 заглавная буква, 1 цифра, 1 спец. символ'],
            ['name', 'match', 'pattern' => '/^([а-яА-ЯёЁa-zA-Z]+[ ]+)([а-яА-ЯёЁa-zA-Z]+)([ ]+[а-яА-ЯёЁa-zA-Z]+)?$/u', 'message'=>'Кирилица, 3 слова'],
            [['role'], 'integer'],
            [['name', 'age', 'gender', 'email', 'phone', 'password', 'username'], 'string', 'max' => 255],
            [['username', 'phone', 'email'], 'unique', 'targetAttribute' => ['username', 'phone','email']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'age' => 'Age',
            'gender' => 'Gender',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'role' => 'Role',
            'username' => 'Username',
        ];
    }

    /**
     * Gets query for [[ResumPols]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*
    public function getResumPols()
    {
        return $this->hasMany(ResumPols::class, ['user_id' => 'id']);
    }
*/


//----------------------------------------------------

public static function findIdentity($id)
{
}
public static function findIdentityByAccessToken($token, $type = null)
{
return static::findOne(['token' => $token]);
}
public function getId()
{
return $this->id;
}
public function getAuthKey()
{
}
public function validateAuthKey($authKey)
{
}








public function isAdmin() {
    $roles = new Role;
    $admin_role = $roles::findOne(['name' => 'admin']);
    return $this->role === $admin_role['id_role'];
}

public function isAuthorized() {
    $token = str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization'));
    if (!$token || $token != $this->token) {
        return false;
    }
    return true;
}
public static function getByToken() {
    return self::findOne(['token' => str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization'))]);
}







const SCENARIO_UPDATE = 'update';
const SCENARIO_UPDATE_EMAIL = 'update_email';
const SCENARIO_DEFAULT = 'default';
public function scenarios(){
return [
    self::SCENARIO_UPDATE => ['phone'],
    self::SCENARIO_UPDATE_EMAIL => ['email'],
    self::SCENARIO_DEFAULT => ['name', 'age', 'gender', 'email', 'phone', 'password', 'username', 'role'],
];
}




}
