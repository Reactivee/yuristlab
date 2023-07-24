<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "get_job".
 *
 * @property int $id
 * @property int|null $job_id
 * @property int|null $user_id
 * @property int|null $employ_id
 */
class GetJob extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'get_job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'user_id', 'employ_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_id' => 'Job ID',
            'user_id' => 'User ID',
            'employ_id' => 'Employ ID',
        ];
    }

    public function getAllJob()
    {
        $job = Jobs::find()->all();
        return ArrayHelper::map($job, 'id', 'name_uz');
    }

    public function getAllEmploy()
    {
        $emp = Employ::find()->all();
        return ArrayHelper::map($emp, 'id', 'first_name');
    }

    public function getJob()
    {
        return $this->hasOne(Jobs::className(), ['id' => 'job_id']);
    }

    public function getEmploy()
    {
        return $this->hasOne(Employ::className(), ['id' => 'employ_id']);
    }
}
