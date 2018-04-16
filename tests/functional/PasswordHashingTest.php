<?php

use app\models\user\UserRecord;

class PasswordHashingTest extends \Codeception\Test\Unit
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testPasswordIsHashedWhenSavingUser()
    {
        $user = $this->imagineUserRecord();
        
        $plaintext_password = $user->password;
        
        $user->save();
        
        // Don't care about mutated model now, just fetch new one.
        $saved_user = UserRecord::findOne($user->id);
        
        $security = new \yii\base\Security();
        $this->assertInstanceOf(get_class($user), $saved_user);
        $this->assertTrue(
            $security->validatePassword(
                $plaintext_password,
                $saved_user->password
            )
        );
    }
    
    // TODO remove duplication
    private function imagineUserRecord()
    {
        $faker = \Faker\Factory::create();
        
        $user = new UserRecord();
        $user->username = $faker->word;
        $user->password = md5(time());
        return $user;
    }
    
    /** @test */
    public function testPasswordIsNotRehashedAfterUpdatingWithoutChangingPassword()
    {
        $user = $this->imagineUserRecord();
        $user->save();
        
        /** @var UserRecord $saved_user */
        $saved_user = UserRecord::findOne($user->id);
        $expected_hash = $saved_user->password;
        
        $saved_user->username = md5(time());
        $saved_user->save();
        
        /** @var UserRecord $updated_user */
        $updated_user = UserRecord::findOne($saved_user->id);
        
        $this->assertEquals($expected_hash, $saved_user->password);
        $this->assertEquals($expected_hash, $updated_user->password);
    }
}
