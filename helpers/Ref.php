<?php
namespace app\helpers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\MstUnit;
use app\models\MstStatus;
use app\models\MstJenis;
use app\models\MstTrx;

class Ref
{
    public static function getUnit()
    {
        return ArrayHelper::map(MstUnit::find()->all(),'id','nama');
    }

    public static function getStatus()
    {
        return ArrayHelper::map(MstStatus::find()->all(),'id','nama');
    }

    public static function getSimpananPokok()
    {
        $model = MstJenis::find()->limit(1)->one();
        if ($model) return $model->id;
        return null;
        
    }

    public static function getActiveStatus()
    {
        $model = MstStatus::find()->limit(1)->orderBy(['id'=>SORT_ASC])->one();
        if ($model) return $model->id;
        return null;
    }

    public static function getCommit()
    {
        $model = MstTrx::find()->limit(1)->orderBy(['id'=>SORT_ASC])->one();
        if ($model) return $model->id;
        return null;
    }

    public static function now()
    {
        return Yii::$app->formatter->asDatetime(time(),'php:Y-m-d H:i:s');
    }

    public static function debit()
    {
        return 'D';
    }

    public static function kredit()
    {
        return 'K';
    }




}