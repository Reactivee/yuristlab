<?php

namespace common\models\documents;


use common\models\Employ;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

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

    const NEW = 1;
    const EDITED = 2;
    const DELETED = -1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content_news';
    }

//    public function behaviors()
//    {
//        return [
//            TimestampBehavior::className(),
//        ];
//    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path'], 'string'],
//            [['status'], 'required'],
            [['status', 'created_at', 'updated_at', 'created_by', 'category_id', 'views'], 'integer'],
            [['title_uz', 'title_ru'], 'string', 'max' => 255],
            [['text_uz', 'text_ru', 'sub_title_uz', 'sub_title_ru'], 'safe']
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

    public function getStatusName($status = null)
    {
        $array = [
            self::NEW => 'Yangi',
            self::DELETED => "O'chirish",

        ];

        return $status ? $array[$status] : $array;
    }

    public function getCategory()
    {
        $cats = CategoryNews::find()->where(['status' => 1])->all();
        return ArrayHelper::map($cats, 'id', 'name_uz');
    }

    public function getCategoryname()
    {

        return $this->hasOne(CategoryNews::className(), ['id' => 'category_id']);
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $user = Yii::$app->user->identity->employ;
            $this->created_by = $user->id;
        }
        return parent::beforeSave($insert);

    }

    public function getUser()
    {
        return $this->hasOne(Employ::className(), ['id' => 'created_by']);
    }
}
