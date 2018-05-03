<?php

use yii\db\Migration;

/**
 * Class m180322_173800_init_phone_table
 */
class m180322_173800_init_phone_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'phone',
            [
                'id' => 'pk',
                'customer_id' => 'int',
                'number' => 'string',
            ]
        );
        
        $this->addForeignKey(
            'customer_phone_numbers', 
            'phone', 'customer_id', 
            'customer', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('customer_phone_numbers', 'phone');
        $this->dropTable('phone');
        
        //echo "m180322_173800_init_phone_table cannot be reverted.\n";

        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180322_173800_init_phone_table cannot be reverted.\n";

        return false;
    }
    */
}
