<?php

namespace common\models\c2\statics;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * ConfigType
 *
 * @author ben
 */
class ChessType extends AbstractStaticClass {

    const TYPE_DEFAULT = 1;  // default
    const TYPE_BRANCH = 2;  // branch

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
                static::TYPE_DEFAULT => ['id' => static::TYPE_DEFAULT, 'label' => Yii::t('app.c2', 'Default')],
                static::TYPE_BRANCH => ['id' => static::TYPE_BRANCH, 'label' => Yii::t('app.c2', 'Branch')],
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
