<?php
namespace app\helpers;

use Yii;

class RefDashboard
{
    public static function anggota()
    {
        $sql = "
        select
        sum(if(b.nama = 'Kementerian Perhubungan' and c.nama = 'Aktif',1,0)) phb_aktif,
        sum(if(b.nama = 'Kementerian Perhubungan' and c.nama = 'Non Aktif',1,0)) phb_non_aktif,
        sum(if(b.nama <> 'Kementerian Perhubungan' and c.nama = 'Aktif',1,0)) non_phb_aktif,
        sum(if(b.nama <> 'Kementerian Perhubungan' and c.nama = 'Non Aktif',1,0)) non_phb_non_aktif
        from mst_anggota a
        inner join mst_unit b on a.mst_unit_id = b.id
        inner join mst_status c on a.mst_status_id = c.id
        ";

        return  Yii::$app->db->createCommand($sql)->queryOne();
    }

    public static function simpanan($tahun='')
    {
        if (empty($tahun)){
            $tahun = date('Y');
        }

        $sql = "
        select 
        b.nama,
        ifnull(sum(a.jumlah),0) jumlah
        from (select jumlah,tgl_trx from dt_simpanan where status_trx='2' and date_format(tgl_trx,'%Y')='$tahun') a
        right join mst_bulan b on b.id_bulan = date_format(a.tgl_trx,'%m')
        group by b.id_bulan
        ";
        return  Yii::$app->db->createCommand($sql)->queryAll();
    }

    public static function angsuran($tahun='')
    {
        if (empty($tahun)){
            $tahun = date('Y');
        }

        $sql = "
        select 
        b.nama,
        ifnull(sum(a.jumlah),0) jumlah
        from (select (jumlah) jumlah,tgl_trx from dt_angsuran where status_trx='2' 
        and date_format(tgl_trx,'%Y')='$tahun') a
        right join mst_bulan b on b.id_bulan = date_format(a.tgl_trx,'%m')
        group by b.id_bulan
        ";
        return  Yii::$app->db->createCommand($sql)->queryAll();
    }

    public static function pinjaman($tahun='')
    {
        if (empty($tahun)){
            $tahun = date('Y');
        }

        $sql = "
        select 
        b.nama,
        ifnull(sum(a.jumlah),0) jumlah
        from (select (jumlah) jumlah,tgl_trx from dt_pinjaman where status_trx='2' 
        and date_format(tgl_trx,'%Y')='$tahun') a
        right join mst_bulan b on b.id_bulan = date_format(a.tgl_trx,'%m')
        group by b.id_bulan
        ";
        return  Yii::$app->db->createCommand($sql)->queryAll();
    }
}





