<?php

namespace common\models\c2\statics;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * ConfigType
 *
 * @author ben
 */
class UserProfitType extends AbstractStaticClass {

    const TYPE_PROFIT = 1;  // load in when config settings init
    const TYPE_AWARD = 2;  // load in when demand

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
                static::TYPE_PROFIT => ['id' => static::TYPE_PROFIT, 'label' => Yii::t('app.c2', 'Kpi profit')],
                static::TYPE_AWARD => ['id' => static::TYPE_AWARD, 'label' => Yii::t('app.c2', 'Kpi award')],
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

}
