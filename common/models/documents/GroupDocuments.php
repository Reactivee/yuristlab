<?php

namespace common\models\documents;

use Yii;
use yii\behaviors\TimestampBehavior;

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
    const ACTIVE = 1;
    const NOACTIVE = -1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_documents';
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
            [['status',], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name_uz', 'name_ru', 'key', 'path'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getStatusName($status = null)
    {
        $array = [
            self::ACTIVE => 'Active',
            self::NOACTIVE => 'NoActive',

        ];

        return $status ? $array[$status] : $array;
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
