<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/7
 * Time: 10:37
 */

namespace frontend\widgets;


use common\models\c2\entity\FeUserModel;
use yii\base\Widget;

class ChessStation extends Widget
{

    /**
     * @var FeUserModel
     */
    public $user;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        $currentChess = $this->user->getCurrentChess()->getChess()->one();
        return $this->render('chess_station', [
            'currentChess' => $currentChess
        ]);
    }

}