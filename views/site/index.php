<?php
use app\widgets\Panel;
use app\helpers\RefDashboard;
use miloschuman\highcharts\Highcharts;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->title = 'Dashboard Koperasi';
$anggota = RefDashboard::anggota();
$simpanan = RefDashboard::simpanan();
$angsuran = RefDashboard::angsuran();
$pinjaman = RefDashboard::pinjaman();

$bulan = ArrayHelper::getColumn($simpanan,'nama');
$jumlah_simpanan = array_map(function($value){
    return floatval($value);
},ArrayHelper::getColumn($simpanan,'jumlah'));
$jumlah_angsuran = array_map(function($value){
    return floatval($value);
},ArrayHelper::getColumn($angsuran,'jumlah'));
$jumlah_pinjaman = array_map(function($value){
    return floatval($value);
},ArrayHelper::getColumn($pinjaman,'jumlah'));

?>
<div class="site-index">

    <div class="row">
        <div class="col-lg-3">
            <?php Panel::begin(['header'=>false]);?>       
                <h4 class="text-center">Anggota Perhubungan Aktif</h4>
                <h4 class="text-center"><?=ArrayHelper::getValue($anggota,'phb_aktif');?></h4>
            <?php Panel::end();?>
        </div>
        <div class="col-lg-3">
            <?php Panel::begin(['header'=>false]);?>       
                <h4 class="text-center">Anggota Perhubungan Non Aktif</h4>
                <h4 class="text-center"><?=ArrayHelper::getValue($anggota,'phb_non_aktif');?></h4>
            <?php Panel::end();?>
        </div>
        <div class="col-lg-3">
            <?php Panel::begin(['header'=>false]);?>       
                <h4 class="text-center ">Anggota Non Perhubungan Aktif</h4>
                <h4 class="text-center"><?=ArrayHelper::getValue($anggota,'non_phb_aktif');?></h4>
            <?php Panel::end();?>
        </div>
        <div class="col-lg-3">
            <?php Panel::begin(['header'=>false]);?>       
                <h4 class="text-center">Anggota Non Perhubungan Non Aktif</h4>
                <h4 class="text-center"><?=ArrayHelper::getValue($anggota,'non_phb_non_aktif');?></h4>
            <?php Panel::end();?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php Panel::begin(['header'=>false]);?>       
            <?=Highcharts::widget([
            'options' => [
                'chart'=>[
                    'type'=>'column'
                ],
                'title' => ['text' => 'Saldo Koperasi Tahun'],
                'xAxis' => [
                    'categories' => $bulan
                ],
                'yAxis' => [
                    'min'=>0,
                    'title' => ['text' => 'Jumlah Saldo'],
                   
                ],
                
                'series' => [
                    ['name' => 'Simpanan', 'data' => $jumlah_simpanan],
                    ['name' => 'Angsuran', 'data' => $jumlah_angsuran]
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
                'chart'=>[
                    'type'=>'line'
                ],
                'title' => ['text' => 'Peminjaman Koperasi Tahun'],
                'xAxis' => [
                    'categories' => $bulan
                ],
                'yAxis' => [
                    'title' => ['text' => 'Jumlah Pinjaman']
                ],
                'plotOptions'=>[
                    'line'=>[
                        'dataLabels'=>[
                            'enabled'=>true
                        ]
                    ]
                ],
                'series' => [
                    ['name' => 'Pinjaman', 'data' => $jumlah_pinjaman ],
                 
                ]
            ]
            ]);?>
            <?php Panel::end();?>
        </div>
    </div>
            
</div>
