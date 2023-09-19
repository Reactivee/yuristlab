<?php

namespace common\models\user;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\user\SocialEmploy;

/**
 * SocialEmploySearch represents the model behind the search form of `common\models\user\SocialEmploy`.
 */
class SocialEmploySearch extends SocialEmploy
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'key'], 'integer'],
            [['name_uz', 'name_ru', 'icon', 'img', 'link'], 'safe'],
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
        $query = SocialEmploy::find();

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
        ]);

        $query->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
