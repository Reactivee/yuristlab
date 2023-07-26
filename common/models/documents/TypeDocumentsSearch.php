<?php

namespace common\models\documents;

use common\models\documents\TypeDocuments;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * TypeDocumentsSearch represents the model behind the search form of `common\models\documents\TypeDocuments`.
 */
class TypeDocumentsSearch extends TypeDocuments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'status', 'created_at', 'updated_at'], 'integer'],
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
        dd($params);
        $type = $params['type'];
        $query = TypeDocuments::find();
        if ($type)
            $query->where(['id' => $type]);

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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }

    public function searchTemplate($params)
    {
        $query = TypeDocuments::find();
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
        $arr = [];
        if ($params->group_doc) {
            $gr = CategoryDocuments::find()
                ->where(['group_id' => $params->group_doc])
                ->all();

            $cat_arr = ArrayHelper::map($gr, 'id', 'id');
            $sub = CategoryDocuments::find()
                ->where(['parent_id' => $cat_arr])
                ->all();
            $res = ArrayHelper::map($sub, 'id', 'id');
            $arr = array_merge($arr, $res);

        }

        if ($params->category) {
            $sub = CategoryDocuments::find()
                ->where(['parent_id' => $params->category])
                ->all();
            $res = ArrayHelper::map($sub, 'id', 'id');
            $arr = array_merge($arr, $res);

        }

        if ($params->sub_category) {
            $res = $params->sub_category;
            $arr = array_merge($arr, $res);
        }

        if ($arr) {
            $query->andFilterWhere([
                'category_id' => $arr,
            ]);
        } else {
            $query->andFilterWhere([
//                'category_id' => 1,
            ]);
        }


        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'category_id' => $this->category_id,
//            'status' => $this->status,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//        ]);

//        $query->andFilterWhere(['like', 'name_uz', $this->name_uz])
//            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
//            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
