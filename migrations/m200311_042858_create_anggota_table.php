<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%anggota}}`.
 */
class m200311_042858_create_anggota_table extends Migration
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

        $this->createTable('{{%mst_anggota}}', [
            'id' => $this->string(64)->notNull(),
            'nip' => $this->string(),
            'nama' => $this->string()->notNull(),
            'jk' => $this->string(),
            'jabatan' => $this->string(),
            'golongan' => $this->string(),
            'bagian' => $this->string(),
            'sub_bagian' => $this->string(),
            'foto'=> $this->string(),
            'telp'=> $this->string(),
            'email'=> $this->string(),
            'alamat'=> $this->text(),
            'mst_status_id'=>$this->integer()->unsigned()->notNull(),
            'mst_unit_id' => $this->string(64)->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'PRIMARY KEY(id)'
        ],$tableOptions);
        if ($this->db->driverName === 'mysql') {
        $this->addForeignKey(
            'fk-anggota-status',
            'mst_anggota',
            'mst_status_id',
            'mst_status',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-anggota-unit',
            'mst_anggota',
            'mst_unit_id',
            'mst_unit',
            'id',
            'NO ACTION'
        );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mst_anggota}}');
    }
}
