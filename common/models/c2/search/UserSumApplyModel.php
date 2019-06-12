<?php

namespace common\models\c2\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c2\entity\UserSumApplyModel as UserSumApplyModelModel;

/**
 * UserSumApplyModel represents the model behind the search form about `common\models\c2\entity\UserSumApplyModel`.
 */
class UserSumApplyModel extends UserSumApplyModelModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['type', 'bank_name', 'hash', 'confirmed_at', 'name', 'mobile_number', 'memo', 'bank_card_number', 'state', 'status', 'created_at', 'updated_at'], 'safe'],
            [['apply_sum', 'transfer_rate', 'received_sum'], 'number'],
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
        $query = UserSumApplyModelModel::find();

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
            'apply_sum' => $this->apply_sum,
            'confirmed_at' => $this->confirmed_at,
            'transfer_rate' => $this->transfer_rate,
            'received_sum' => $this->received_sum,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'hash', $this->hash])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'bank_card_number', $this->bank_card_number])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
    
    public function getPageParamName($splitor = '-'){
        $name = "UserSumApplyModelModelPage";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
    
    public function getSortParamName($splitor = '-'){
        $name = "UserSumApplyModelModelSort";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
}
