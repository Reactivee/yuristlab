<?php

namespace common\models;

use common\models\Employ;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * EmploySearch represents the model behind the search form of `common\models\Employ`.
 */
class EmploySearch extends Employ
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'user_id', 'type', 'company_id', 'role'], 'integer'],
            [['first_name', 'last_name', 'key', 'desc', 'phone', 'photo', 'login'], 'safe'],
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
        $query = Employ::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'company_id' => $this->company_id,
            'role' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'login', $this->login]);

        return $dataProvider;
    }

    public function searchLawyer($params)
    {
        $query = Employ::find()
            ->where(['role' => User::LAWYER]);


        if ($params['slug']) {
            $query->andWhere(['id' => $params['slug']]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;

    }
}
