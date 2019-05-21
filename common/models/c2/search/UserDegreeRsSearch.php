<?php

namespace common\models\c2\search;

use common\models\c2\entity\UserDegreeRsModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Config represents the model behind the search form about `common\models\c2\entity\Config`.
 */
class UserDegreeRsSearch extends UserDegreeRsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'degree_id', 'position'], 'integer'],
            [['user_id', 'degree_id', 'position', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = UserDegreeRsModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'sortParam' => $this->getSortParamName(),
            ],
            'pagination' => [
                'pageParam' => $this->getPageParamName(),
                'pageSize' => 20,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'degree_id' => $this->degree_id,
            'status' => $this->status,
            'position' => $this->position,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        // $query->andFilterWhere(['like', 'code', $this->code])
        //     ->andFilterWhere(['like', 'label', $this->label])
        //     ->andFilterWhere(['like', 'default_value', $this->default_value])
        //     ->andFilterWhere(['like', 'custom_value', $this->custom_value])
        //     ->andFilterWhere(['like', 'memo', $this->memo]);

        return $dataProvider;
    }
    
    public function getPageParamName($splitor = '-'){
        $name = "UserDegreeRsModelPage";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
    
    public function getSortParamName($splitor = '-'){
        $name = "UserDegreeRsModelSort";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
}
