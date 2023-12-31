<?php

namespace common\models\documents;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "attached_document".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int|null $main_document_id
 * @property int $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property string|null $path
 */
class AttachedDocument extends \yii\db\ActiveRecord
{
    public $generate_name;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attached_document';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['name_uz', 'name_ru',], 'required'],
            [['main_document_id', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['name_uz', 'name_ru', 'path', 'generate_name'], 'string', 'max' => 255],
//            [['name_uz'], 'unique'],
//            [['name_ru'], 'unique'],
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
            'main_document_id' => 'Main Document ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'path' => 'Path',
        ];
    }
}
