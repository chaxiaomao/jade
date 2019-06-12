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
class SumApplyState extends AbstractStaticClass
{

    const STATE_INIT = 1;
    const STATE_REFUSE = 2;
    const STATE_FINISH = 3;

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
                static::STATE_INIT => ['id' => static::STATE_INIT, 'label' => Yii::t('app.c2', 'Submit Apply')],
                static::STATE_REFUSE => ['id' => static::STATE_REFUSE, 'label' => Yii::t('app.c2', 'Refuse')],
                static::STATE_FINISH => ['id' => static::STATE_FINISH, 'label' => Yii::t('app.c2', 'Finish')],
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