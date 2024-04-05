<?php

namespace common\models;

/**
 * This is the model class for table "company_templates".
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $group_id
 * @property string|null $path
 */
class CompanyTemplates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'group_id', 'company_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'group_id' => 'Group ID',
            'path' => 'Path',
        ];
    }
}
