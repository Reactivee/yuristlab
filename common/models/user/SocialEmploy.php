<?php

namespace common\models\user;

use Yii;

/**
 * This is the model class for table "social_employ".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property string|null $icon
 * @property string|null $img
 * @property int|null $key
 * @property string|null $link
 */
class SocialEmploy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social_employ';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'integer'],
            [['name_uz', 'name_ru', 'icon', 'img', 'link'], 'string', 'max' => 255],
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
            'link' => 'Link',
        ];
    }
}
