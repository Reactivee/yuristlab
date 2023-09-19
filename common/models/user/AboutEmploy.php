<?php

namespace common\models\user;

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
 * @property int|null $begin_date
 * @property int|null $end_date
 * @property string|null $text_ru
 * @property string|null $text_uz
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
            [['key', 'status', 'begin_date', 'end_date'], 'integer'],
            [['text'], 'string'],
            [['name_uz', 'name_ru', 'icon', 'img', 'text_ru', 'text_uz'], 'string', 'max' => 255],
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
            'begin_date' => 'Begin Date',
            'end_date' => 'End Date',
            'text_ru' => 'Text Ru',
            'text_uz' => 'Text Uz',
        ];
    }
}
