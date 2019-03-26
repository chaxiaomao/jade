<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 17:42
 */

namespace common\models\c2\statics;
use Yii;

/**
 *
 * Class FeUserType
 * @package common\models\c2\statics
 */
class FeUserType extends AbstractStaticClass
{
    //Lord 领主
    // Elder 长老
    // Chieftain 首领
    // Master 主人
    // Familiar 仆人
    // Peasant 农民
    const TYPE_DEFAULT = 100;
    const TYPE_LORD = 6; // LV6
    const TYPE_ELDER = 5; // LV5
    const TYPE_CHIEFTAIN = 4; // LV4
    const TYPE_MASTER = 3; // LV3
    const TYPE_FAMILIAR = 2; // LV2
    const TYPE_PEASANT = 1; // LV1

    protected static $_data;

    /**
     *
     * @param type $id
     * @param type $attr
     * @return string|array
     */
    public static function getData($id = '', $attr = '') {
        if (is_null(static::$_data)) {
            static::$_data = [
                static::TYPE_DEFAULT => ['id' => static::TYPE_DEFAULT, 'modelClass' => '\common\models\c2\entity\FeUserProfile', 'label' => Yii::t('app.c2', 'Default')],
                static::TYPE_LORD => ['id' => static::TYPE_LORD, 'modelClass' => '\common\models\c2\entity\MerchantProfile', 'label' => Yii::t('app.c2', 'Lord')],
                static::TYPE_ELDER => ['id' => static::TYPE_ELDER, 'modelClass' => '\common\models\c2\entity\SalesmanProfile', 'label' => Yii::t('app.c2', 'Elder')],
                static::TYPE_CHIEFTAIN => ['id' => static::TYPE_CHIEFTAIN, 'modelClass' => '\common\models\c2\entity\CustomerProfile', 'label' => Yii::t('app.c2', 'Chieftain')],
                static::TYPE_MASTER => ['id' => static::TYPE_MASTER, 'modelClass' => '\common\models\c2\entity\FranchiseeProfile', 'label' => Yii::t('app.c2', 'Master')],
                static::TYPE_FAMILIAR => ['id' => static::TYPE_FAMILIAR, 'modelClass' => '\common\models\c2\entity\DistributorProfile', 'label' => Yii::t('app.c2', 'Familiar')],
                static::TYPE_PEASANT => ['id' => static::TYPE_PEASANT, 'modelClass' => '\common\models\c2\entity\BizManagerProfile', 'label' => Yii::t('app.c2', 'Peasant')],
            ];
        }
        if ($id !== '' && !empty($attr)) {
            return static::$_data[$id][$attr];
        }
        if ($id !== '' && empty($attr)) {
            return static::$_data[$id];
        }
        return static::$_data;
    }

    public static function getModelClass($id) {
        return static::getData($id, 'modelClass');
    }

}