<?php

use app\models\customer\CustomerRecord;
use app\models\user\UserRecord;

class CustomerAuditTest extends \Codeception\Test\Unit
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;
    
    /** @test */
    public function testNewCustomerHasAuditInfo()
    {
        // Dependencies
        $identity = UserRecord::findOne(['username' => 'RobAdmin']);
        $user = Yii::$app->user;
        
        // Given
        $user->login($identity);
        $customer = $this->imagineCustomerRecord();
        $before = time();
        $customer->save();
        $after = time();
        
        // When
        /** @var CustomerRecord #saved */
        $saved = CustomerRecord::findOne($customer->id);
        
        // Then
        $this->assertInstanceOf('app\models\customer\CustomerRecord', $saved);
        $this->assertBetween($before, $saved->created_at, $after);
        $this->assertEquals($user->id, $saved->created_by);
        $this->assertEquals($saved->created_at, $saved->updated_at);
        $this->assertEquals($saved->created_by, $saved->updated_by);
    }
    
    /** @return CustomerRecord */
    private function imagineCustomerRecord()
    {
        $faker = \Faker\Factory::create();
        $record = new CustomerRecord();
        $record->name = $faker->name;
        return $record;
    }
    
    private function assertBetween($before, $value, $after)
    {
        $this->assertLessThanOrEqual($before, $value);
        $this->assertGreterThanOrEqual($value, $after);
    }
}
