<?php

namespace common\models\c2\statics;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * ConfigType
 *
 * @author ben
 */
class UserProfitState extends AbstractStaticClass {

    const ASSIGNED = 1;  // load in when config settings init
    const COMMIT = 2;  // load in when demand

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
                static::ASSIGNED => ['id' => static::ASSIGNED, 'label' => Yii::t('app.c2', 'Profit Assigned')],
                static::COMMIT => ['id' => static::COMMIT, 'label' => Yii::t('app.c2', 'Profit Commit')],
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
