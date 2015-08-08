<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cards;

/**
 * CardSearch represents the model behind the search form about `app\models\Card`.
 */
class CardsSearch extends Cards
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deck_id'], 'integer'],
            [['content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Cards::find();
		print_r($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort' => [
				'attributes' => ['content'],
			],
        ]);

        // load the seach form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['deck_id' => $this->deck_id]);
        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
