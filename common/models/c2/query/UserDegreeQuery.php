<?php

namespace common\models\c2\query;
use common\models\c2\entity\UserDegreeRsModel;

/**
 * This is the ActiveQuery class for [[\common\models\c2\entity\UserDegreeModel]].
 *
 * @see \common\models\c2\entity\UserDegreeModel
 */
class UserDegreeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\c2\entity\UserDegreeModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\entity\UserDegreeModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\entity\UserDegreeModel|array|null
     */
    public function visible() {
        return $this->andWhere(['{{%user_degree}}.visible' => 1])->orderBy(['position' => SORT_DESC]);
    }

    /**
     *
     * @param type $catIds
     */
    public function belongCategories($productId) {
        $subQuery = UserDegreeRsModel::find()->select('degree_id')->where(['product_id' => $productId]);
        return $this->andWhere(['id' => $subQuery]);
    }
}
