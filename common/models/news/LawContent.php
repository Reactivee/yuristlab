<?php

namespace common\models\news;

use Yii;

/**
 * This is the model class for table "law_content".
 *
 * @property int $id
 * @property int|null $law_id
 * @property string|null $title_uz
 * @property string|null $title_ru
 * @property string|null $text_ru
 * @property string|null $text_uz
 * @property int $status
 * @property string|null $image
 */
class LawContent extends \yii\db\ActiveRecord
{
    const NEW = 1;
    const EDITED = 2;
    const DELETED = -1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'law_content';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['law_id', 'status'], 'integer'],
            [['status'], 'required'],
            [['text_ru', 'text_uz'], 'safe'],
            [['title_uz', 'title_ru'], 'string', 'max' => 255],
            [['image',], 'safe'],
            ['image', 'file', 'extensions' => ['pdf', 'docx', 'doc'], 'maxSize' => 300 * 300 * 1,],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'law_id' => 'Law ID',
            'title_uz' => 'Title Uz',
            'title_ru' => 'Title Ru',
            'text_ru' => 'Text Ru',
            'text_uz' => 'Text Uz',
            'status' => 'Status',
            'image' => 'Image',
        ];
    }

    public function getStatusName($status = null)
    {
        $array = [
            self::NEW => 'Yangi',
            self::DELETED => "O'chirish",

        ];

        return $status ? $array[$status] : $array;
    }

    public function getLaw()
    {
        return $this->hasOne(LawNews::className(), ['id' => 'law_id']);
    }
}
