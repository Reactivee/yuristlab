<?php

namespace common\models\documents;

use Yii;

/**
 * This is the model class for table "content_news".
 *
 * @property int $id
 * @property string|null $title_uz
 * @property string|null $title_ru
 * @property string|null $text_uz
 * @property string|null $text_ru
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 */
class ContentNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text_uz', 'text_ru', 'path'], 'string'],
            [['status'], 'required'],
            [['status', 'created_at', 'updated_at', 'created_by', 'category_id'], 'integer'],
            [['title_uz', 'title_ru'], 'string', 'max' => 255],
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
            'text_uz' => 'Text Uz',
            'text_ru' => 'Text Ru',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }
}
