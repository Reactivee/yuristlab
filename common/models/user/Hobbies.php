<?php

namespace common\models\user;

use Yii;

/**
 * This is the model class for table "hobbies".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property string|null $icon
 * @property string|null $img
 */
class Hobbies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hobbies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru', 'icon', 'img'], 'string', 'max' => 255],
            [['employ_id'], 'safe'],
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
        ];
    }
}
