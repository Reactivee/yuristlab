<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "about_employ".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property string|null $icon
 * @property string|null $img
 * @property int|null $key
 * @property string|null $text
 * @property int|null $status
 */
class AboutEmploy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about_employ';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'status'], 'integer'],
            [['text'], 'string'],
            [['name_uz', 'name_ru', 'icon', 'img'], 'string', 'max' => 255],
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
            'icon' => 'Icon',
            'img' => 'Img',
            'key' => 'Key',
            'text' => 'Text',
            'status' => 'Status',
        ];
    }
}
