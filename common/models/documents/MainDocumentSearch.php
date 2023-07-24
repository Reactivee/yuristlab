<?php

namespace common\models\documents;

use common\models\documents\MainDocument;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MainDocumentSearch represents the model behind the search form of `common\models\documents\MainDocument`.
 */
class MainDocumentSearch extends MainDocument
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'group_id', 'status', 'created_at', 'updated_at', 'created_by', 'time_begin', 'time_end'], 'integer'],
            [['name_uz', 'name_ru', 'path'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = MainDocument::find()->orderBy(['id' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($params['status']) {
            $status = $params['status'];
            $query->where(['status' => $status]);
        }
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'group_id' => $this->group_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'time_begin' => $this->time_begin,
            'time_end' => $this->time_end,
        ]);

        $query->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }

    public function searchLawyer($params)
    {

        $query = MainDocument::find()->orderBy(['id' => SORT_DESC])->where(['not', ['status' => MainDocument::NEW]]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($params['status']) {
            $status = $params['status'];
            $query->andWhere(['status' => $status]);
        }
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'group_id' => $this->group_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'time_begin' => $this->time_begin,
            'time_end' => $this->time_end,
        ]);

        $query->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }

    public function searchDirector($params)
    {


        $query = MainDocument::find()
            ->orderBy(['main_document.id' => SORT_DESC])
            ->where(['status' => MainDocument::TOBOSS])
            ->andWhere(['company_id' => Yii::$app->user->identity->employ->company->id]);
//            ->andWhere(['status'=>MainDocument::TOBOSS]);
//            ->innerJoin(CategoryDocuments::tableName(), 'main_document . category_id = category_documents . id')
//            ->andWhere(['category_documents . group_id' => 3]);

//        dd($query);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($params['status']) {
            $status = $params['status'];
            $query->andWhere(['status' => $status]);
        }
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0 = 1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'group_id' => $this->group_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'time_begin' => $this->time_begin,
            'time_end' => $this->time_end,
        ]);

        $query->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
