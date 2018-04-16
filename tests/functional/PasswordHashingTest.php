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
}