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
        $this->createTable('{{%angsuran}}', [
            'id' => $this->string(64)->primaryKey()->notNull(),
            'dt_pinjaman_id' => $this->primaryKey(),
            'angsuran_pokok' => $this->primaryKey(),
            'angsuran_bunga' => $this->primaryKey(),
            'angsuran_ke' => $this->primaryKey(),
            'tgl_trx' => $this->primaryKey(),
            'status_trx' => $this->primaryKey(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-post_tag-post_id',
            'post_tag',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%angsuran}}');
    }
}
