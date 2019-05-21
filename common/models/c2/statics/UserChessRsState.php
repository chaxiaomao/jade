<?php

namespace common\models\c2\statics;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * ConfigType
 *
 * @author ben
 */
class UserChessRsState extends AbstractStaticClass {

    const TYPE_INIT = 1;  // load in when demand
    const TYPE_FINISH = 2;  // load in when config settings init
    
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
                static::TYPE_INIT => ['id' => static::TYPE_INIT, 'label' => Yii::t('app.c2', 'Init')],
                static::TYPE_FINISH => ['id' => static::TYPE_FINISH, 'label' => Yii::t('app.c2', 'Finish')],
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
