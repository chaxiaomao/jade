<?php

namespace common\models\c2\statics;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * ConfigType
 *
 * @author ben
 */
class GRPStationType extends AbstractStaticClass {

    const TYPE_C3 = 1;
    const TYPE_C2 = 2;
    const TYPE_C1 = 3;
    const TYPE_B = 4;
    const TYPE_A = 5;
    const TYPE_P = 6;

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
                static::TYPE_C3 => ['id' => static::TYPE_C3, 'label' => Yii::t('app.c2', 'Type C3')],
                static::TYPE_C2 => ['id' => static::TYPE_C2, 'label' => Yii::t('app.c2', 'Type C2')],
                static::TYPE_C1 => ['id' => static::TYPE_C1, 'label' => Yii::t('app.c2', 'Type C1')],
                static::TYPE_B => ['id' => static::TYPE_B, 'label' => Yii::t('app.c2', 'Type B')],
                static::TYPE_A => ['id' => static::TYPE_A, 'label' => Yii::t('app.c2', 'Type A')],
                static::TYPE_P => ['id' => static::TYPE_P, 'label' => Yii::t('app.c2', 'Type P')],
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
