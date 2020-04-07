<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%angsuran}}`.
 */
class m200311_043139_create_angsuran_table extends Migration
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
        $this->createTable('{{%dt_angsuran}}', [
            'id' => $this->string(64)->notNull(),
            'dt_pinjaman_id' => $this->string(64)->notNull(),
            'angsuran_pokok' => $this->decimal(10,2)->notNull(),
            'angsuran_bunga' => $this->decimal(10,2)->notNull(),
            'angsuran_ke' => $this->integer()->notNull(),
            'tgl_trx' => $this->datetime()->notNull(),
            'status_trx' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'PRIMARY KEY(id)'
        ],$tableOptions);

        $this->addForeignKey(
            'fk-angsuran-pinjaman',
            'dt_angsuran',
            'dt_pinjaman_id',
            'dt_pinjaman',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-angsuran-trx',
            'dt_angsuran',
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
        $this->dropTable('{{%dt_angsuran}}');
    }
}
