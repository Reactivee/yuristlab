<?php

namespace common\models\documents;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\documents\MainDocument;

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
        $query = MainDocument::find();

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
