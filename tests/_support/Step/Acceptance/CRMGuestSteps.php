<?php
namespace Step\Acceptance;

class CRMGuestSteps extends \AcceptanceTester
{
    public $username;
    public $password;
    
    public function __construct($scenario)
    {
        parent::__construct($scenario);
        
        // Automatically login the user, if user and pass are set
        if ($this->username and $this->password)
            $this->login($this->username, $this->password);
    }
    
    public function login($username, $password)
    {
        $I = $this;
        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', $username);
        $I->fillField('LoginForm[password]', $password);
        $I->click('Login');
        $I->wait(1); // Wait because JS validation
        $I->seeCurrentUrlEquals('/web_app_dev_yii2_php/yii2-crmapp/web/');
    }
    
    public function logout()
    {
        $I = $this;
        // Move to homepage, because it could be in an exception page
        $I->amOnPage('/');
        // Expecting that this button is presented on the homepage.
        $I->click('logout');
        //$I->wait(1);
        //$I->see('guest');
    }
}
