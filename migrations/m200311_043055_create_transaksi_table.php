<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaksi}}`.
 */
class m200311_043055_create_transaksi_table extends Migration
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

        $this->createTable('{{%dt_transaksi}}', [
            'id' => $this->string(64)->notNull(),
            'tgl_trx' => $this->datetime(),
            'jumlah' => $this->decimal(10,2)->notNull(),
            'status_trx' => $this->integer()->unsigned()->notNull(),
            'ref_id' => $this->string(64)->notNull(),
            'tipe' => $this->string(1)->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dt_transaksi}}');
    }
}
