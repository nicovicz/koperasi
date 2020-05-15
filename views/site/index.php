<?php
use app\widgets\Panel;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="row">
        <div class="col-lg-3">
            <?php Panel::begin(['header'=>false]);?>       
                <h4 class="text-center">Anggota Perhubungan Aktif</h4>
                <h4 class="text-center">7000</h4>
            <?php Panel::end();?>
        </div>
        <div class="col-lg-3">
            <?php Panel::begin(['header'=>false]);?>       
                <h4 class="text-center text-danger">Anggota Perhubungan Non Aktif</h4>
                <h4 class="text-center">7000</h4>
            <?php Panel::end();?>
        </div>
        <div class="col-lg-3">
            <?php Panel::begin(['header'=>false]);?>       
                <h4 class="text-center ">Anggota Non Perhubungan Aktif</h4>
                <h4 class="text-center">7000</h4>
            <?php Panel::end();?>
        </div>
        <div class="col-lg-3">
            <?php Panel::begin(['header'=>false]);?>       
                <h4 class="text-center text-danger">Anggota Non Perhubungan Non Aktif</h4>
                <h4 class="text-center">7000</h4>
            <?php Panel::end();?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php Panel::begin(['header'=>false]);?>       
            <?=Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Saldo Koperasi Bulan'],
                'xAxis' => [
                    'categories' => ['Apples', 'Bananas', 'Oranges']
                ],
                'yAxis' => [
                    'title' => ['text' => 'Fruit eaten']
                ],
                'series' => [
                    ['name' => 'Jane', 'data' => [1, 0, 4]],
                    ['name' => 'John', 'data' => [5, 7, 3]]
                ]
            ]
            ]);?>
            <?php Panel::end();?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php Panel::begin(['header'=>false]);?>       
            <?=Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Peminjaman Koperasi Bulan'],
                'xAxis' => [
                    'categories' => ['Apples', 'Bananas', 'Oranges']
                ],
                'yAxis' => [
                    'title' => ['text' => 'Fruit eaten']
                ],
                'series' => [
                    ['name' => 'Jane', 'data' => [1, 0, 4]],
                    ['name' => 'John', 'data' => [5, 7, 3]]
                ]
            ]
            ]);?>
            <?php Panel::end();?>
        </div>
    </div>
            
</div>
