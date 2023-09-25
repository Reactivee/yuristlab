<?php

namespace common\models\user;

use common\models\Employ;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "about_employ".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property string|null $icon
 * @property string|null $img
 * @property int|null $key
 * @property string|null $text
 * @property int|null $status
 * @property int|null $begin_date
 * @property int|null $end_date
 * @property string|null $text_ru
 * @property string|null $text_uz
 */
class AboutEmploy extends \yii\db\ActiveRecord
{


    const EDU = 1;
    const WORK_PLACE = 2;
    const WORK_EXP = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about_employ';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'employ_id'], 'integer'],
            [['begin_date', 'end_date', 'key'], 'safe'],
            [['name_uz', 'name_ru', 'icon', 'img', 'text_ru', 'text_uz', 'text'], 'safe'],
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
            'icon' => 'Icon',
            'img' => 'Img',
            'key' => 'Key',
            'text' => 'Text',
            'status' => 'Status',
            'begin_date' => 'Begin Date',
            'end_date' => 'End Date',
            'text_ru' => 'Text Ru',
            'text_uz' => 'Text Uz',
        ];
    }

    public function getEmploy()
    {
        $emp = Employ::find()->all();

        return ArrayHelper::map($emp, 'id', function ($model) {
            return $model['first_name'] . '-' . $model['last_name'];
        });
    }

    public function getKeys()
    {
        $keys = [
            self::EDU => "Ta'lim muassalari",
            self::WORK_EXP => 'Ish faoliyati',
            self::WORK_PLACE => 'Ishlagan muassasalari',
        ];

        return $keys;
    }
}
