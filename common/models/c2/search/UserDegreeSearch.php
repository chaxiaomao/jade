<?php

namespace common\models\c2\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c2\entity\UserDegreeModel;

/**
 * UserDegreeSearch represents the model behind the search form about `common\models\c2\entity\UserDegreeModel`.
 */
class UserDegreeSearch extends UserDegreeModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'chess_id', 'root', 'lft', 'rgt', 'lvl', 'created_by', 'updated_by', 'position'], 'integer'],
            [['type', 'selected', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all', 'disabled', 'active', 'code', 'name', 'label', 'description', 'icon', 'icon_type', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = UserDegreeModel::find();

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
            'chess_id' => $this->chess_id,
            'root' => $this->root,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'lvl' => $this->lvl,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'position' => $this->position,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'selected', $this->selected])
            ->andFilterWhere(['like', 'readonly', $this->readonly])
            ->andFilterWhere(['like', 'visible', $this->visible])
            ->andFilterWhere(['like', 'collapsed', $this->collapsed])
            ->andFilterWhere(['like', 'movable_u', $this->movable_u])
            ->andFilterWhere(['like', 'movable_d', $this->movable_d])
            ->andFilterWhere(['like', 'movable_l', $this->movable_l])
            ->andFilterWhere(['like', 'movable_r', $this->movable_r])
            ->andFilterWhere(['like', 'removable', $this->removable])
            ->andFilterWhere(['like', 'removable_all', $this->removable_all])
            ->andFilterWhere(['like', 'disabled', $this->disabled])
            ->andFilterWhere(['like', 'active', $this->active])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'icon_type', $this->icon_type])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
    
    public function getPageParamName($splitor = '-'){
        $name = "UserDegreeModelPage";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
    
    public function getSortParamName($splitor = '-'){
        $name = "UserDegreeModelSort";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
}
