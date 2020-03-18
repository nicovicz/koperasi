<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pinjaman}}`.
 */
class m200311_043123_create_pinjaman_table extends Migration
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

        $this->createTable('{{%dt_pinjaman}}', [
            'id' => $this->string(64)->notNull(),
            'tgl_trx' => $this->datetime()->notNull(),
            'jumlah' => $this->decimal(10,2)->notNull(),
            'bunga' => $this->decimal(10,2)->notNull(),
            'tenor' => $this->integer()->notNull(),
            'status_trx' => $this->string(64)->notNull(),
            'mst_anggota_id' =>$this->string(64)->notNull(),
            'mst_jenis_id' => $this->string(64)->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'PRIMARY KEY(id)'
        ],$tableOptions);

        $this->addForeignKey(
            'fk-pinjaman-anggota',
            'dt_pinjaman',
            'mst_anggota_id',
            'mst_anggota',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-pinjaman-jenis',
            'dt_pinjaman',
            'mst_jenis_id',
            'mst_jenis',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-pinjaman-trx',
            'dt_pinjaman',
            'status_trx',
            'mst_trx',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dt_pinjaman}}');
    }
}
