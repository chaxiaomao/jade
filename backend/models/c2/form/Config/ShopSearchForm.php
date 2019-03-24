<?php
/**
 * Created by PhpStorm.
 * User: ming yan
 * Date: 2017/6/14
 * Time: 10:48
 */

namespace backend\models\c2\form\Config;
use backend\components\Timerange;
use Yii;
use yii\base\Model;

class ShopSearchForm extends Model {
    public $date_from;
    public $date_to;
    public $timeArr;
    public function init() {
        $this->loadDefaultValues();
        parent::init();
    }

    public function rules() {
        return [
            [['date_from', 'date_to',], 'required'],
            ['date_from', 'compare', 'compareAttribute' => 'date_to', 'operator' => '<='],
//            ['date_from', Timerange::className(), 'compareAttribute' => 'date_to', 'range' =>6],
        ];
    }

    public function attributeLabels() {
        return [
            'date_from' => Yii::t('app.c2', 'Date From'),
            'date_to' => Yii::t('app.c2', 'Date To'),
        ];
    }

    /*Access to store time range*/
    public function loadDefaultValues() {
        $nowDate = new \DateTime();
        $nowDate->sub(new \DateInterval('P1D'));
        if ($this->load(Yii::$app->request->post())) {
            $this->date_from = date('Y-m-d',strtotime($this->date_from));
            $this->date_to = date('Y-m-d',strtotime($this->date_to));
        }else{
            $this->date_from = date('Y-m-01');
            $this->date_to = date("Y-m-d");
        }
        $startDate = \DateTime::createFromFormat("Y-m-d",$nowDate->format($this->date_from));
        $endDate = \DateTime::createFromFormat("Y-m-d",$nowDate->format(date("Y-m-d",strtotime($this->date_to)+24*3600)));
        $timeArr = [];
        $periodInt = new \DateInterval("P1D");
        $period = new \DatePeriod($startDate,$periodInt,$endDate);
        $i = 0;
        foreach($period as $dt){
            $timeArr[$i]['start'] = $dt->format("Y-m-d 00:00:00");
            $timeArr[$i]['end'] = $dt->format("Y-m-d 23:59:59");
            $i++;
        }
        $this->timeArr = $timeArr;
    }
}