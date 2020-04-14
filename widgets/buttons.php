<?php
use yii\helpers\Html;
?>
<div class="col-lg-12">

    <hr/>
 <div class="pull-right clearfix">
 <?= Html::submitButton('<i class="fa fa-save"></i> '.Yii::t('app', 'Simpan'), ['class' => 'btn btn-success']) ?>
 <?= Html::resetButton('<i class="fa fa-refresh"></i> '.Yii::t('app', 'Batal'), ['class' => 'btn btn-primary']) ?>
 <?=$this->render('@app/widgets/back-button');?>
</div>

</div>
