<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property string|null $key
 * @property string|null $logo
 * @property string|null $address
 * @property int|null $type
 * @property string|null $official
 * @property string|null $desc
 * @property int|null $director
 * @property int|null $status
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'director', 'status'], 'integer'],
            [['desc'], 'string'],
            [['name_uz', 'name_ru', 'key', 'logo', 'address', 'official'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uz' => 'Name Uz',
            'name_ru' => 'Name Ru',
            'key' => 'Key',
            'logo' => 'Logo',
            'address' => 'Address',
            'type' => 'Type',
            'official' => 'Official',
            'desc' => 'Desc',
            'director' => 'Director',
            'status' => 'Status',
        ];
    }

    public function getDir()
    {
        $emp = Employ::find()->all();
        return ArrayHelper::map($emp, 'id', 'first_name');
//        return $this->hasOne(Employ::className())
    }

    public function getEmploy()
    {
        return $this->hasOne(Employ::className(), ['id' => 'director']);

    }
}
