<?php

namespace common\models\documents;

use Yii;

/**
 * This is the model class for table "group_documents".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int $status
 * @property int $created_at
 * @property int|null $updated_at
 */
class GroupDocuments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru', 'status', 'created_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
            [['name_uz'], 'unique'],
            [['name_ru'], 'unique'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GroupDocumentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupDocumentsQuery(get_called_class());
    }
}
