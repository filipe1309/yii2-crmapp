<?php

use yii\db\Migration;

/**
 * Class m180417_122504_add_auth_key_to_user
 */
class m180417_122504_add_auth_key_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'auth_key', 'string UNIQUE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'auth_key');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180417_122504_add_auth_key_to_user cannot be reverted.\n";

        return false;
    }
    */
}
