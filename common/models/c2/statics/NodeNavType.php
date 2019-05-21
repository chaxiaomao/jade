<?php

namespace common\models\c2\statics;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * ConfigType
 *
 * @author ben
 */
class NodeNavType extends AbstractStaticClass {

    const TYPE_CHILDREN = 1;  // default
    const TYPE_SIBLING = 2;  // branch

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
                static::TYPE_CHILDREN => ['id' => static::TYPE_CHILDREN, 'label' => Yii::t('app.c2', 'Children Node')],
                static::TYPE_SIBLING => ['id' => static::TYPE_SIBLING, 'label' => Yii::t('app.c2', 'Sibling Node')],
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
