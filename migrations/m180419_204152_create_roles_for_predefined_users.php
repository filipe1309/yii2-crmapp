<?php

use app\models\user\UserRecord;
use yii\db\Migration;

/**
 * Class m180419_204152_create_roles_for_predefined_users
 */
class m180419_204152_create_roles_for_predefined_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $rbac = Yii::$app->authManager;
        
        $guest = $rbac->createRole('guest');
        $guest->description = 'Nobody';
        $rbac->add($guest);
        
        $user = $rbac->createRole('user');
        $user->description = 'Can use the query UI and nothing else';
        $rbac->add($user);
        
        $manager = $rbac->createRole('manager');
        $manager->description = 'Can manage entities in database, but not users';
        $rbac->add($manager);
        
        $admin = $rbac->createRole('admin');
        $admin->description = 'Can do anything including managing users';
        $rbac->add($admin);
        
        $rbac->addChild($admin, $manager);
        $rbac->addChild($manager, $user);
        $rbac->addChild($user, $guest);
        
        $rbac->assign($user, UserRecord::findOne(['username' => 'JoeUser'])->id);
        $rbac->assign($manager, UserRecord::findOne(['username' => 'AnnieManager'])->id);
        $rbac->assign($admin, UserRecord::findOne(['username' => 'RobAdmin'])->id);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $manager = Yii::$app->authManager;
        $manager->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180419_204152_create_roles_for_predefined_users cannot be reverted.\n";

        return false;
    }
    */
}
