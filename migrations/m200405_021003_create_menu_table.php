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
                        'icon'=>'fa fa-arrow-right'
                    ],
                    [
                        'label'=>'Anggota',
                        'route'=>'/anggota/anggota/index',
                        'icon'=>'fa fa-arrow-right'
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
                        'icon'=>null
                    ],
                    [
                        'label'=>'Daftar Simpanan',
                        'route'=>'/simpanan/simpanan/index',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Tambah Pinjaman',
                        'route'=>'/pinjaman/pinjaman/create',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Pinjaman',
                        'route'=>'/pinjaman/pinjaman/index',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Tambah Angsuran',
                        'route'=>'/angsuran/angsuran/create',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Angsuran',
                        'route'=>'/angsuran/angsuran/index',
                        'icon'=>null
                    ],
                ]
            ],
            [
                'label'=>'Anggota',
                'route'=>'#',
                'icon'=>'fa fa-users',
                'items'=>[
                    [
                        'label'=>'Tambah Anggota',
                        'route'=>'/anggota/anggota/create',
                        'icon'=>'fa fa-arrow-right'
                    ],
                    [
                        'label'=>'Anggota',
                        'route'=>'/anggota/anggota/index',
                        'icon'=>'fa fa-arrow-right'
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
                        'icon'=>null
                    ],
                    [
                        'label'=>'Jenis',
                        'route'=>'/master/jenis/index',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Tambah Status',
                        'route'=>'/master/status/create',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Status',
                        'route'=>'/master/status/index',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Tambah Transaksi',
                        'route'=>'/master/trx/create',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Transaksi',
                        'route'=>'/master/trx/index',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Tambah Unit',
                        'route'=>'/master/unit/create',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Unit',
                        'route'=>'/master/unit/index',
                        'icon'=>null
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
                        'icon'=>null
                    ],
                    [
                        'label'=>'Hak Akses',
                        'route'=>'/utilitas/role/index',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Tambah Hak Izin',
                        'route'=>'/utilitas/route/create',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Hak Izin',
                        'route'=>'/utilitas/route/index',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Tambah Akun',
                        'route'=>'/utilitas/user/create',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Akun',
                        'route'=>'/utilitas/user/index',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Tambah Menu',
                        'route'=>'/utilitas/menu/create',
                        'icon'=>null
                    ],
                    [
                        'label'=>'Menu',
                        'route'=>'/utilitas/menu/index',
                        'icon'=>null
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
