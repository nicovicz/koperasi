<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trans_log}}`.
 */
class m200311_065208_create_trans_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%trans_log}}', [
            'id' => $this->string(64)->primaryKey()->notNull(),
            'pesan' => $this->primaryKey(),
            'data'=>$this->text(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%trans_log}}');
    }
}
