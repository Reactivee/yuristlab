<?php

namespace common\models\documents;

use Yii;

/**
 * This is the model class for table "category_news".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property int $status
 */
class CategoryNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
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
        ];
    }
}
