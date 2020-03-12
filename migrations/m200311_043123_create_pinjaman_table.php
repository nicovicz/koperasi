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
        $this->createTable('{{%pinjaman}}', [
            'id' => $this->string(64)->primaryKey()->notNull(),
            'tgl_trx' => $this->primaryKey(),
            'jumlah' => $this->primaryKey(),
            'bunga' => $this->primaryKey(),
            'tenor' => $this->primaryKey(),
            'status_trx' => $this->primaryKey(),
            'mst_anggota_id' => $this->primaryKey(),
            'mst_jenis_id' => $this->primaryKey(),
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
        $this->dropTable('{{%pinjaman}}');
    }
}
