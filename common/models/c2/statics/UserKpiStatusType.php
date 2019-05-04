<?php

namespace common\models\c2\statics;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * ConfigType
 *
 * @author ben
 */
class UserKpiStatusType extends AbstractStaticClass {

    const TYPE_COMMIT = 1;  // load in when demand
    const TYPE_NOT_COMMIT = 2;  // load in when config settings init
    
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
                static::TYPE_COMMIT => ['id' => static::TYPE_COMMIT, 'label' => Yii::t('app.c2', 'Commit')],
                static::TYPE_NOT_COMMIT => ['id' => static::TYPE_NOT_COMMIT, 'label' => Yii::t('app.c2', 'Not commit')],
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
