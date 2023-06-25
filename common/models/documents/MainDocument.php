<?php

namespace common\models\documents;

use Yii;

/**
 * This is the model class for table "main_document".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int|null $category_id
 * @property int|null $group_id
 * @property int $status
 * @property int $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property string|null $path
 * @property int|null $time_begin
 * @property int|null $time_end
 */
class MainDocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru', 'status', 'created_at'], 'required'],
            [['category_id', 'group_id', 'status', 'created_at', 'updated_at', 'created_by', 'time_begin', 'time_end'], 'integer'],
            [['name_uz', 'name_ru', 'path'], 'string', 'max' => 255],
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
            'category_id' => 'Category ID',
            'group_id' => 'Group ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'path' => 'Path',
            'time_begin' => 'Time Begin',
            'time_end' => 'Time End',
        ];
    }
}
