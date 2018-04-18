<?php

use yii\db\Migration;

/**
 * Class m180418_183529_add_predefined_users
 */
class m180418_183529_add_predefined_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach (
            [
                'JoeUser' => '7 wonder @ American soil',
                'AnnieManager' => 'Shiny 3 things hmm, vulnerable',
                'RobAdmin' => 'Imitate #14th symptom of apathy'
            ] as $username => $password
        ) {
            $user = new \app\models\user\UserRecord();
            $user->attributes = compact('username', 'password');
            $user->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180418_183529_add_predefined_users cannot be reverted.\n";

        return false;
    }
    */
}
