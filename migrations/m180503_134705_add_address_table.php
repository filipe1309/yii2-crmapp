<?php

use yii\db\Migration;

/**
 * Class m180503_134705_add_address_table
 */
class m180503_134705_add_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'address',
            [
                'id' => 'pk',
                'purpose' => 'string',
                'country' => 'string',
                'state' => 'string',
                'city' => 'string',
                'street' => 'string',
                'building' => 'string',
                'apartment' => 'string',
                'received_name' => 'string',
                'postal_code' => 'string',
                'customer_id' => 'int not null'
            ]
        );
        
        // add foreign key with name on table column referencing table column
        $this->addForeignKey(
            'customer_address', 
            'address', 'customer_id', 
            'customer', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('customer_address', 'address');
        $this->dropTable('address');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180503_134705_add_address_table cannot be reverted.\n";

        return false;
    }
    */
}
