<?php

namespace common\models\news;

use Yii;

/**
 * This is the model class for table "law_news".
 *
 * @property int $id
 * @property string|null $title_uz
 * @property string|null $title_ru
 * @property int $status
 * @property string|null $icon
 */
class LawNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'law_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'integer'],
            [['title_uz', 'title_ru', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_uz' => 'Title Uz',
            'title_ru' => 'Title Ru',
            'status' => 'Status',
            'icon' => 'Icon',
        ];
    }
}
