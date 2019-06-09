<?php

namespace common\models\c2\statics;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * ConfigType
 *
 * @author ben
 */
class GRPState extends AbstractStaticClass {

    const TYPE_DEFAULT = 1;  // default
    const TYPE_INIT = 2;  // branch
    const TYPE_FINISH = 3;  // branch
    const TYPE_CLOSE = 4;  // branch

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
                static::TYPE_INIT => ['id' => static::TYPE_INIT, 'label' => Yii::t('app.c2', 'Init')],
                static::TYPE_FINISH => ['id' => static::TYPE_FINISH, 'label' => Yii::t('app.c2', 'Finish')],
                static::TYPE_CLOSE => ['id' => static::TYPE_CLOSE, 'label' => Yii::t('app.c2', 'Close')],
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
