<?php

namespace common\models\c2\statics;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * ConfigType
 *
 * @author ben
 */
class UserKpiStateType extends AbstractStaticClass {

    const TYPE_NOT_COMMIT = 1;
    const TYPE_CHIEFTAIN_COMMIT = 2;
    const TYPE_ADMIN_COMMIT = 3;
    const TYPE_FINISH_COMMIT = 4;

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
                static::TYPE_NOT_COMMIT => ['id' => static::TYPE_NOT_COMMIT, 'label' => Yii::t('app.c2', 'Not commit')],
                static::TYPE_CHIEFTAIN_COMMIT => ['id' => static::TYPE_CHIEFTAIN_COMMIT, 'label' => Yii::t('app.c2', 'Chieftain commit')],
                static::TYPE_ADMIN_COMMIT => ['id' => static::TYPE_ADMIN_COMMIT, 'label' => Yii::t('app.c2', 'Admin commit')],
                static::TYPE_FINISH_COMMIT => ['id' => static::TYPE_FINISH_COMMIT, 'label' => Yii::t('app.c2', 'Finish commit')],
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
