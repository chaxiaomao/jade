<?php

namespace common\models\c2\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c2\entity\ChessModel;

/**
 * ChessSearch represents the model behind the search form about `common\models\c2\entity\ChessModel`.
 */
class ChessSearch extends ChessModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lord_id', 'elder_id', 'chieftain_id', 'attributeset_id', 'province_id', 'city_id', 'district_id', 'created_by', 'updated_by', 'position'], 'integer'],
            [['type', 'code', 'label', 'biz_registration_number', 'product_style', 'tel', 'open_id', 'wechat_open_id', 'geo_longitude', 'geo_latitude', 'geo_marker_color', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = ChessModel::find();

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
            'lord_id' => $this->lord_id,
            'elder_id' => $this->elder_id,
            'chieftain_id' => $this->chieftain_id,
            'attributeset_id' => $this->attributeset_id,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'district_id' => $this->district_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'position' => $this->position,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'biz_registration_number', $this->biz_registration_number])
            ->andFilterWhere(['like', 'product_style', $this->product_style])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'open_id', $this->open_id])
            ->andFilterWhere(['like', 'wechat_open_id', $this->wechat_open_id])
            ->andFilterWhere(['like', 'geo_longitude', $this->geo_longitude])
            ->andFilterWhere(['like', 'geo_latitude', $this->geo_latitude])
            ->andFilterWhere(['like', 'geo_marker_color', $this->geo_marker_color])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
    
    public function getPageParamName($splitor = '-'){
        $name = "ChessModelPage";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
    
    public function getSortParamName($splitor = '-'){
        $name = "ChessModelSort";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
}
