<?php

use yii\db\Migration;
/**
 * Handles the creation of table `{{%status}}`.
 */
class m200311_020353_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%mst_status}}', [
            'id' => $this->primaryKey()->unsigned(),
            'nama' => $this->string()->notNull(),
            'data' => $this->text(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
           
        ],$tableOptions);

        $this->insert('{{%mst_status}}',[
            'nama'=>'Aktif',
            'data'=>json_encode([
                'template'=>'badge label-success',
                'icon' =>'fa fa-check-circle',
                'icon_confirm' =>'fa fa-times-circle',
                'label_anggota'=>'Aktif',
                'label_pinjaman'=>'Lunas',
                'message_confirm_anggota'=>'Apakah Anda Akan Menonaktifkan Anggota Ini?',
                'tooltip_anggota'=>'Nonaktifkan Anggota',
                'message_confirm_pinjaman'=>'Apakah Anda Akan Membatalkan Pinjaman Ini?',
                'tooltip_pinjaman'=>'Batalkan Pinjaman'
            ]),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $this->insert('{{%mst_status}}',[
            'nama'=>'Non Aktif',
            'data'=>json_encode([
                'template'=>'badge label-danger',
                'icon' =>'fa fa-times-circle',
                'icon_confirm' =>'fa fa-check-circle',
                'label_anggota'=>'Tidak Aktif',
                'label_pinjaman'=>'Belum Lunas',
                'message_confirm_anggota'=>'Apakah Anda Akan Mengaktifkan Anggota Ini?',
                'tooltip_anggota'=>'Aktifkan Anggota',
                
              
            ]),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mst_status}}');
    }
}
