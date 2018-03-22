<?php

use yii\db\Migration;

/**
 * Class m180322_172400_init_customer_table
 */
class m180322_172400_init_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'customer',
            [
                'id' => 'pk',
                'name' => 'string',
                'birth_date' => 'date',
                'notes' => 'text',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('customer');
        
        //echo "m180322_172400_init_customer_table cannot be reverted.\n";

        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180322_172400_init_customer_table cannot be reverted.\n";

        return false;
    }
    */
}
