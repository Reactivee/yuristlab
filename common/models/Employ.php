<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employ".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int|null $status
 * @property int|null $user_id
 * @property string|null $key
 * @property string|null $desc
 * @property int|null $type
 * @property string|null $phone
 * @property string|null $photo
 * @property int|null $company_id
 * @property int|null $role
 * @property string|null $login
 */
class Employ extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const ADMIN = 10;
    const MODERATOR = 11;
    const EMPLOY = 12;
    const LAWYER = 13;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employ';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'user_id', 'type', 'company_id', 'role'], 'integer'],
            [['desc'], 'string'],
            [['first_name', 'last_name', 'key', 'phone', 'photo', 'login'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'status' => 'Status',
            'user_id' => 'User ID',
            'key' => 'Key',
            'desc' => 'Desc',
            'type' => 'Type',
            'phone' => 'Phone',
            'photo' => 'Photo',
            'company_id' => 'Company ID',
            'role' => 'Role',
            'login' => 'Login',
        ];
    }
    public static function getRole($role = null)
    {
        $array = [
            self::ADMIN => 'admin',
            self::MODERATOR => 'moderator',
            self::EMPLOY => 'Xodim',
            self::LAWYER => 'Yurist',
        ];

        return $role ? $array[$role] : $array;
    }

    public function getStatus($status = null)
    {
        $array = [
            self::STATUS_ACTIVE => 'active',
            self::STATUS_INACTIVE => 'No active',
        ];

        return $status ? $array[$status] : $array;
    }

    public function getAllUser()
    {
        $users = User::find()->all();
        return ArrayHelper::map($users, 'id', 'username');
    }

    public function getAllCompany()
    {
        $comp = Company::find()->all();
        return ArrayHelper::map($comp, 'id', 'name_uz');
    }

    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getLawyers()
    {
        $law = self::find()
            ->select(["CONCAT(first_name, ' ', last_name) AS first_name",'id'])
            ->where(['role' => User::LAWYER, 'status' => self::STATUS_ACTIVE])

            ->all();

        return ArrayHelper::map($law, 'id', 'first_name');


    }

}
