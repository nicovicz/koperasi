<?php

use yii\db\Migration;
use thamtech\uuid\helpers\UuidHelper;
use app\models\MstUnit;
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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%mst_jenis}}', [
            'id' => $this->string(64)->notNull(),
            'nama' => $this->string()->notNull(),
            'jumlah'=>$this->decimal(10,2),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'PRIMARY KEY(id)'
        ],$tableOptions);

        $this->createTable('{{%dt_group_simpanan}}', [
            'id' => $this->string(64)->notNull(),
            'mst_jenis_id' => $this->string()->notNull(),
            'mst_unit_id' => $this->string()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'PRIMARY KEY(id)'
        ],$tableOptions);

        $this->addForeignKey(
            'fk-group-jenis',
            'dt_group_simpanan',
            'mst_jenis_id',
            'mst_jenis',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-group-unit',
            'dt_group_simpanan',
            'mst_unit_id',
            'mst_unit',
            'id',
            'NO ACTION'
        );
        
        $pokok = UuidHelper::uuid();
        $this->insert('{{%mst_jenis}}',[
            'id'=> $pokok,
            'nama'=>'Simpanan Pokok',
            'jumlah'=>300000,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $this->insert('{{%mst_jenis}}',[
            'id'=>$wajib = UuidHelper::uuid(),
            'nama'=>'Simpanan Wajib',
            'jumlah'=>500000,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $sukarela = UuidHelper::uuid();
        $this->insert('{{%mst_jenis}}',[
            'id'=>$sukarela,
            'nama'=>'Simpanan Sukarela' ,
            'jumlah'=>0,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $this->insert('{{%mst_jenis}}',[
            'id'=>UuidHelper::uuid(),
            'nama'=>'Pinjaman Bunga Tetap',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $unit = MstUnit::find()->all();
        if ($unit){

            foreach($unit as $u){

                $this->insert('{{%dt_group_simpanan}}', [
                    'id' => UuidHelper::uuid(),
                    'mst_jenis_id' => $pokok,
                    'mst_unit_id' => $u['id'],
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'created_by'=>1,
                    'updated_by'=>1,
                ]);

                if ($u['nama'] != 'Kementerian Perhubungan'){

                    $this->insert('{{%dt_group_simpanan}}', [
                        'id' => UuidHelper::uuid(),
                        'mst_jenis_id' => $sukarela,
                        'mst_unit_id' => $u['id'],
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                        'created_by'=>1,
                        'updated_by'=>1,
                    ]);
                }
                
            }
        }

        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mst_jenis}}');
        $this->dropTable('{{%dt_group_simpanan}}');
        
    }
}
