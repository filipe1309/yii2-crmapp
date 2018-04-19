<?php

class RoleHierarchyTest extends \Codeception\Test\Unit
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;
    
    /** @var \yii\web\User */
    private $user;
    
    protected function _before()
    {
        $this->user = Yii::$app->user;
    }

    protected function _after()
    {
        $this->user->logout();
    }

    // tests
    public function testDefaultRoleIsGuest()
    {
        // no login at all
        
        $this->assertFalse($this->user->can('admin'));
        $this->assertFalse($this->user->can('manager'));
        $this->assertFalse($this->user->can('user'));
        $this->assertTrue($this->user->can('guest'));
    }
    
    public function predefinedUserRoles()
    {
        return [
            ['RobAdmin',     ['admin' => true,  'manager' => true,  'user' => true, 'guest' => true]],
            ['AnnieManager', ['admin' => false, 'manager' => true,  'user' => true, 'guest' => true]],
            ['JoeUser',      ['admin' => false, 'manager' => false, 'user' => true, 'guest' => true]],
        ];
    }
    
    /**
     * @test
     * @dataProvider predefinedUserRoles
     * @param string $username
     * @param array $rbac
     */
    public function testPredefinedUsersHasProperRoles($username, $rbac)
    {
        $identity = \app\models\user\UserRecord::findOne(compact('username'));
        
        $this->user->login($identity);
        
        // Check whether user->can() is behaving according to our role hierarchy
        // for each of these predefined users
        foreach ($rbac as $role => $allowed)
            $this->assertEquals($allowed, $this->user->can($role));
    }
}