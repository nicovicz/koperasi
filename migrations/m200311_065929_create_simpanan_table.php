<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%simpanan}}`.
 */
class m200311_065929_create_simpanan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%simpanan}}', [
            'id' => $this->string(64)->primaryKey()->notNull(),
            'jumlah' => $this->primaryKey(),
            'tgl_trx' => $this->primaryKey(),
            'status_trx' => $this->primaryKey(),
            'mst_jenis_id' => $this->primaryKey(),
            'mst_anggota_id' => $this->primaryKey(),
            'created_at' => $this->datetime()->notNull(),
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
        $this->dropTable('{{%simpanan}}');
    }
}
