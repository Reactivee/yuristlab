<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jobs".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property int|null $status
 * @property string|null $key
 * @property string|null $desc
 * @property int|null $type
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'type'], 'integer'],
            [['desc'], 'string'],
            [['name_uz', 'name_ru', 'key'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'key' => 'Key',
            'desc' => 'Desc',
            'type' => 'Type',
        ];
    }
}
