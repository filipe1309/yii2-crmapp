<?php

use yii\db\Migration;

/**
 * Class m180503_143321_add_email_table
 */
class m180503_143321_add_email_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'email',
            [
                'id' => 'pk',
                'purpose' => 'string',
                'address' => 'string',
                'customer_id' => 'int not null'
            ]
        );
        
        $this->addForeignKey(
            'customer_email', 
            'email', 'customer_id', 
            'customer', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('customer_email', 'email');
        $this->dropTable('email');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180503_143321_add_email_table cannot be reverted.\n";

        return false;
    }
    */
}
