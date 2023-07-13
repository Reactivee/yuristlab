<?php

namespace backend\modules\admin\models;

use common\library\sms\models\Sms;
use common\library\sms\SMSApiPlayMobile;
use common\system\validators\UsernameUniqueValidator;
use Yii;
use yii\base\Model;
use yii\imagine\Image;
use common\models\User;
use yii\web\UploadedFile;
use backend\models\location\Locations;

/**
 *
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $image
 * @property string $phone
 * @property string $code
 * @property integer $step
 * @property integer $location_id
 * @property string $address
 * @property string $info
 * @property string $password_repeat
 * @property boolean $offer
 *
 * Signup form
 */
class UserSaveForm extends Model
{
    public $step;
    public $username;
    public $email;
    public $first_name;
    public $last_name;
    public $image;
    public $phone;
    public $code;
    public $location_id;
    public $address;
    public $info;
    public $password;
    public $password_repeat;
    public $verify_code;
    public $offer;
    public $role;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь зарегистрирован'],

            [['username', 'first_name', 'last_name', 'phone'], 'string', 'min' => 2, 'max' => 32],
            [['password', 'address', 'role'], 'safe'],
            ['email', 'email'],



        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('model', 'По номеру телефона'),
            'email' => Yii::t('model', 'Эл. адрес'),
            'first_name' => Yii::t('model', 'Имя'),
            'last_name' => Yii::t('model', 'Фамилия'),
            'image' => Yii::t('model', 'Изображение'),
            'code' => Yii::t('model', 'Код подтверждения'),
            'phone' => Yii::t('model', 'Телефон'),
            'location_id' => Yii::t('model', 'Район'),
            'address' => Yii::t('model', 'Адрес'),
            'info' => Yii::t('model', 'Информация'),
            'password' => Yii::t('model', 'Пароль'),
            'password_repeat' => Yii::t('model', 'Повтор пароля'),
            'verify_code' => Yii::t('model', 'Код подтверждения'),
            'offer' => Yii::t('model', 'Я прочитал и принимаю'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateVerifyCode($attribute, $params)
    {
        $condition = [
            'recipient' => clear_phone_full($this->username),
            'code' => $this->code,
            'status' => Sms::STATUS_NOT_VERIFIED,
        ];
        if (SMSApiPlayMobile::checkSMS($condition)) {
            SMSApiPlayMobile::smsVerified($condition);
        } else {
            $this->addError($attribute, 'Неверный код подтверждения.');
        }
    }




    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function userSave()
    {
//        d($this->attributes);
        //dd($this->validate());

        if (!$this->validate()) {
            return null;
        }
//        dd($this->attributes);

        $user = new User();
        $user->username = $this->username;
        $user->phone = clear_phone_full($this->phone);
        $user->email = $this->email;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->image = $this->image;
        $user->location_id = $this->location_id;
        $user->address = $this->address;
        $user->info = $this->info;
        $user->status = User::STATUS_ACTIVE;
        $user->role = (int)$this->role;

        //dd($this->password);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        //dd();

        return $user->save() ? $user : null;
    }


    /**
     * Locations List
     * @return array
     */
    public function getLocationsList()
    {
        return Locations::getLocationsList();
    }
}
