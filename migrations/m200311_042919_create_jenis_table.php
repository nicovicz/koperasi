<?php

use yii\db\Migration;
use thamtech\uuid\helpers\UuidHelper;
/**
 * Handles the creation of table `{{%jenis}}`.
 */
class m200311_042919_create_jenis_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mst_jenis}}', [
            'id' => $this->string(64)->primaryKey()->notNull(),
            'nama' => $this->primaryKey(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        $this->insert('{{%mst_jenis}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'Simpanan Pokok',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $this->insert('{{%mst_jenis}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'Simpanan Wajib',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $this->insert('{{%mst_jenis}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'Pinjaman Bunga menurun (RC)',
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
        $this->dropTable('{{%mst_jenis}}');
    }
}
