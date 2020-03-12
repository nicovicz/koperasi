<?php

use yii\db\Migration;
use thamtech\uuid\helpers\UuidHelper;
/**
 * Handles the creation of table `{{%unit}}`.
 */
class m200311_032933_create_unit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mst_unit}}', [
            'id' => $this->string(64)->primaryKey()->notNull(),
            'nama' => $this->string()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        $this->insert('{{%mst_unit}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'Kementerian Perhubungan',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $this->insert('{{%mst_unit}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'Pelindo I',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $this->insert('{{%mst_unit}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'Pelindo II',
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
        $this->dropTable('{{%mst_unit}}');
    }
}
