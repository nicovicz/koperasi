<?php

use yii\db\Migration;
use thamtech\uuid\helpers\UuidHelper;
/**
 * Handles the creation of table `{{%trx}}`.
 */
class m100318_084314_create_trx_table extends Migration
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

          $this->createTable('{{%mst_trx}}', [
            'id' => $this->string(64)->notNull(),
            'nama' => $this->string()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'PRIMARY KEY(id)'
        ],$tableOptions);

        $this->insert('{{%mst_trx}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'init',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $this->insert('{{%mst_trx}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'commit',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $this->insert('{{%mst_trx}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'rollback',
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
        $this->dropTable('{{%mst_trx}}');
    }
}
