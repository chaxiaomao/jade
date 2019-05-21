<?php

namespace common\models\c2\query;
use common\models\c2\statics\FeUserType;

/**
 * This is the ActiveQuery class for [[\common\models\c2\entity\FeUserModel]].
 *
 * @see \common\models\c2\entity\FeUserModel
 */
class FeUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\c2\entity\FeUserModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\entity\FeUserModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function lords(){
        return $this->andWhere(['{{%fe_user}}.type' => FeUserType::TYPE_LORD]);
    }

    public function elders(){
        return $this->andWhere(['{{%fe_user}}.type' => FeUserType::TYPE_ELDER]);
    }

    public function chieftains(){
        return $this->andWhere(['{{%fe_user}}.type' => FeUserType::TYPE_CHIEFTAIN]);
    }

    public function master()
    {
        return $this->andWhere(['{{%fe_user}}.type' => FeUserType::TYPE_MASTER]);
    }

    public function familiar()
    {
        return $this->andWhere(['{{%fe_user}}.type' => FeUserType::TYPE_FAMILIAR]);
    }

    public function peasant()
    {
        return $this->andWhere(['{{%fe_user}}.type' => FeUserType::TYPE_PEASANT]);
    }

}
