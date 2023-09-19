<?php

namespace common\models\user;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\user\AboutEmploy;

/**
 * AboutEmploySearch represents the model behind the search form of `common\models\user\AboutEmploy`.
 */
class AboutEmploySearch extends AboutEmploy
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'key', 'status', 'begin_date', 'end_date'], 'integer'],
            [['name_uz', 'name_ru', 'icon', 'img', 'text', 'text_ru', 'text_uz'], 'safe'],
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
        $query = AboutEmploy::find();

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
            'key' => $this->key,
            'status' => $this->status,
            'begin_date' => $this->begin_date,
            'end_date' => $this->end_date,
        ]);

        $query->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'text_ru', $this->text_ru])
            ->andFilterWhere(['like', 'text_uz', $this->text_uz]);

        return $dataProvider;
    }
}
