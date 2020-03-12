<?php

use yii\db\Migration;
use thamtech\uuid\helpers\UuidHelper;
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
        $this->createTable('{{%mst_status}}', [
            'id' => $this->string(64)->primaryKey()->notNull(),
            'nama' => $this->string()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        $this->insert('{{%mst_status}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'Aktif',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $this->insert('{{%mst_status}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'Non Aktif',
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
