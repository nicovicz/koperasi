<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m200322_073653_seed
 */
class m200322_073653_seed extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $model = new User();
        $model->username = 'admin';
        $model->email = 'admin@localhost.com';
        $model->setPassword('123456');
        $model->generateAuthKey();
        $model->created_at = time();
        $model->save();

        $auth = Yii::$app->authManager;
        $role = $auth->createRole('SuperAdmin');
        $auth->add($role);
        $auth->assign($role, $model->id);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200322_073653_seed cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200322_073653_seed cannot be reverted.\n";

        return false;
    }
    */
}
