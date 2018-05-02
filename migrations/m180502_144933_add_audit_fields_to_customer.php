<?php

use yii\db\Migration;

/**
 * Class m180502_144933_add_audit_fields_to_customer
 */
class m180502_144933_add_audit_fields_to_customer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customer', 'created_at', 'integer');
        $this->addColumn('customer', 'created_by', 'integer');
        $this->addColumn('customer', 'updated_at', 'integer');
        $this->addColumn('customer', 'updated_by', 'integer');
        
        $this->addForeignKey('customer_created_by', 
            'customer', 'created_by', 'user', 'id');
        $this->addForeignKey('customer_updated_by', 
            'customer', 'updated_by', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('customer_created_by', 'customer');
        $this->dropForeignKey('customer_updated_by', 'customer');
        
        $this->dropColumn('customer', 'created_at');
        $this->dropColumn('customer', 'created_by');
        $this->dropColumn('customer', 'updated_at');
        $this->dropColumn('customer', 'updated_by');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180502_144933_add_audit_fields_to_customer cannot be reverted.\n";

        return false;
    }
    */
}
