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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%dt_trans_log}}', [
            'id' => $this->string(64)->notNull(),
            'pesan' => $this->text()->notNull(),
            'data'=>$this->text()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'PRIMARY KEY(id)'
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dt_trans_log}}');
    }
}
