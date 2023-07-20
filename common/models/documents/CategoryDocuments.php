<?php

namespace common\models\documents;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category_documents".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int|null $group_id
 * @property int|null $parent_id
 * @property int $status
 * @property int $created_at
 * @property int|null $updated_at
 */
class CategoryDocuments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_documents';
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
            [['group_id', 'parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
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
            'group_id' => 'Group ID',
            'parent_id' => 'Parent ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getAllGroup()
    {
        $array = GroupDocuments::find()->where(['status' => 1])->asArray()->all();

        return ArrayHelper::map($array, 'id', 'name_uz');
    }

    public function getGroup()
    {
        return $this->hasOne(GroupDocuments::className(), ['id' => 'group_id']);
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    public static function getCategory($doc_id = null)
    {
        if ($doc_id)
            $array = self::find()->where(['status' => 1, 'parent_id' => null, 'group_id' => $doc_id])->asArray()->all();
        $array = self::find()->where(['status' => 1, 'parent_id' => null])->asArray()->all();

        return ArrayHelper::map($array, 'id', 'name_uz');
    }


    public static function subGetCategory()
    {
        $array = self::find()
            ->where(['status' => 1])
            ->andWhere(['not', ['parent_id' => null]])
            ->asArray()
            ->all();

        return ArrayHelper::map($array, 'id', 'name_ru');
    }

    public static function getSubCategory()
    {
        $array = self::find()->where(['status' => 1])->andWhere(['not', ['parent_id' => null]])->asArray()->all();

        return ArrayHelper::map($array, 'id', 'name_ru');
    }
}
