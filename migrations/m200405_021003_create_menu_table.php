<?php

use yii\db\Migration;
use thamtech\uuid\helpers\UuidHelper;
/**
 * Handles the creation of table `{{%menu}}`.
 */
class m200405_021003_create_menu_table extends Migration
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

        $this->createTable('{{%mst_menu}}', [
            'id' => $this->string(64)->notNull(),
            'name'=>$this->string()->notNull(),
            'parent'=>$this->string(),
            'order'=>$this->integer(),
            'icon'=>$this->string(),
            'route'=>$this->string(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'PRIMARY KEY(id)'
        ],$tableOptions);

       

        $menus = [
            [
                'label'=>'Dahsboard',
                'route'=>'/site/index',
                'icon'=>'fa fa-cog',
            ],
            [
                'label'=>'Anggota',
                'route'=>'#',
                'icon'=>'fa fa-users',
                'items'=>[
                    [
                        'label'=>'Tambah Anggota',
                        'route'=>'/anggota/anggota/create',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Daftar Anggota',
                        'route'=>'/anggota/anggota/index',
                        'icon'=>'fa fa-circle-thin'
                    ],
                ]
            ],
            [
                'label'=>'Simpanan',
                'route'=>'#',
                'icon'=>'fa fa-briefcase',
                'items'=>[
                    [
                        'label'=>'Tambah Simpanan',
                        'route'=>'/simpanan/simpanan/create',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Daftar Simpanan',
                        'route'=>'/simpanan/simpanan/index',
                        'icon'=>'fa fa-circle-thin'
                    ],
                ]
            ],
            [
                'label'=>'Pinjaman',
                'route'=>'#',
                'icon'=>'fa fa-dollar',
                'items'=>[
                    [
                        'label'=>'Tambah Pinjaman',
                        'route'=>'/pinjaman/pinjaman/create',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Daftar Pinjaman',
                        'route'=>'/pinjaman/pinjaman/index',
                        'icon'=>'fa fa-circle-thin'
                    ],
                ]
            ],
            [
                'label'=>'Master',
                'route'=>'#',
                'icon'=>'fa fa-book',
                'items'=>[
                    [
                        'label'=>'Tambah Jenis',
                        'route'=>'/master/jenis/create',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Daftar Jenis',
                        'route'=>'/master/jenis/index',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Tambah Status',
                        'route'=>'/master/status/create',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Daftar Status',
                        'route'=>'/master/status/index',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Tambah Transaksi',
                        'route'=>'/master/trx/create',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Daftar Transaksi',
                        'route'=>'/master/trx/index',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Tambah Unit',
                        'route'=>'/master/unit/create',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Daftar Unit',
                        'route'=>'/master/unit/index',
                        'icon'=>'fa fa-circle-thin'
                    ],
                ]
            ],
            [
                'label'=>'Utilitas',
                'route'=>'#',
                'icon'=>'fa fa-wrench',
                'items'=>[
                    [
                        'label'=>'Tambah Hak Akses',
                        'route'=>'/utilitas/role/create',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Daftar Hak Akses',
                        'route'=>'/utilitas/role/index',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Tambah Hak Izin',
                        'route'=>'/utilitas/route/create',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Daftar Hak Izin',
                        'route'=>'/utilitas/route/index',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Tambah Akun',
                        'route'=>'/utilitas/user/create',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Daftar Akun',
                        'route'=>'/utilitas/user/index',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Tambah Menu',
                        'route'=>'/utilitas/menu/create',
                        'icon'=>'fa fa-circle-thin'
                    ],
                    [
                        'label'=>'Daftar Menu',
                        'route'=>'/utilitas/menu/index',
                        'icon'=>'fa fa-circle-thin'
                    ],
                ]
            ]
        ];

        foreach($menus as $order => $menu){
          $parentId = UuidHelper::uuid();
          $this->insert('mst_menu',[
            'id' => $parentId,
            'name'=>$menu['label'],
            'parent'=>null,
            'order'=>($order+1),
            'icon'=>$menu['icon'],
            'route'=>$menu['route'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => 1
          ]);

          if (array_key_exists('items',$menu)){
              foreach($menu['items'] as $orderChild => $child){
                    $this->insert('mst_menu',[
                        'id' => UuidHelper::uuid(),
                        'name'=>$child['label'],
                        'parent'=>$parentId,
                        'order'=>($orderChild+1),
                        'icon'=>$child['icon'],
                        'route'=>$child['route'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => 1,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => 1
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
        $this->dropTable('{{%menu}}');
    }
}
