<?php
use yii\helpers\Html;
?>
 <p>
        <?=$this->render('@app/widgets/back-button');?>
        <?= Html::a('<i class="fa fa-pencil"></i> Update', ['update', 'id' => $id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash"></i> Delete', ['delete', 'id' => $id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => $confirm,
                'method' => 'post',
            ],
        ]) ?>
</p>
