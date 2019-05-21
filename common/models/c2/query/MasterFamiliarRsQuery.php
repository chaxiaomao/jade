<?php

namespace common\models\c2\query;

/**
 * This is the ActiveQuery class for [[\common\models\c2\entity\MasterFamiliarRsModel]].
 *
 * @see \common\models\c2\entity\MasterFamiliarRsModel
 */
class MasterFamiliarRsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\c2\entity\MasterFamiliarRsModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\entity\MasterFamiliarRsModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
