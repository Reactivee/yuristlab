<?php

namespace common\models\documents;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "type_documents".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int|null $category_id
 * @property int $status
 * @property int $created_at
 * @property int|null $updated_at
 * @property string|null $path
 */
class TypeDocuments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_documents';
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
            [['status'], 'required'],
            [['category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name_uz', 'name_ru', 'path'], 'string', 'max' => 255],
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
            'category_id' => 'Category ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'path' => 'Path',
        ];
    }

    public static function getTypeDoc()
    {
        $array = self::find()
            ->where(['status' => 1])
//            ->andWhere(['not', ['parent_id' => null]])
            ->asArray()
            ->all();

        return ArrayHelper::map($array, 'id', 'name_ru');
    }

    public function getCategory()
    {
        return $this->hasOne(CategoryDocuments::className(), ['id' => 'category_id']);
    }
}
