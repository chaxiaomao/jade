<?php

namespace common\models\c2\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c2\entity\UserKpiModel;

/**
 * UserKpiSearch represents the model behind the search form about `common\models\c2\entity\UserKpiModel`.
 */
class UserKpiSearch extends UserKpiModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grp_id', 'join_user_id', 'invite_user_id', 'grp_station_id', 'c1_id', 'position'], 'integer'],
            [['dues'], 'number'],
            [['type', 'state', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = UserKpiModel::find();

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
            'grp_id' => $this->grp_id,
            'join_user_id' => $this->join_user_id,
            'invite_user_id' => $this->invite_user_id,
            'grp_station_id' => $this->grp_station_id,
            'c1_id' => $this->c1_id,
            'dues' => $this->dues,
            'position' => $this->position,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
    
    public function getPageParamName($splitor = '-'){
        $name = "UserKpiModelPage";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
    
    public function getSortParamName($splitor = '-'){
        $name = "UserKpiModelSort";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
}
