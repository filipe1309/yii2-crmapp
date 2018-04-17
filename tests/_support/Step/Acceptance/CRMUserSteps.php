<?php
namespace Step\Acceptance;

class CRMUserSteps extends \AcceptanceTester
{
    public function amInQueryCustomerUi()
    {
        $I = $this;
        $I->amOnPage('/customers/query');
    }
    
    public function fillInPhoneFieldWithDataForm($customer_data)
    {
        $I = $this;
        $I->fillField(
            'phone_number',
            $customer_data['PhoneRecord[number]']
        );
    }
    
    public function clickSearchButton()
    {
        $I = $this;
        $I->click('Search');
    }
    
    public function seeIAmInListCustomersUi()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('/customers/');
    }
    
    public function seeCustomerInList($customer_data)
    {
        $I = $this;
        $I->see($customer_data['CustomerRecord[name]'], '#search_results');
    }
    
    public function dontSeeCustomerInList($customer_data)
    {
        $I = $this;
        $I->dontSee($customer_data['CustomerRecord[name]'], '#search_results');
    }
    
    public function seeLargeBodyOfText()
    {
        $I = $this;
        $text = $I->grabTextFrom('p'); // naive selector
        $I->seeContentIsLong($text);
    }
    
    public function seeIAmInLoginFormUi()
    {
        $I = $this;
        $I->seeCurrentUrlEquals('/site/login');
    }
    
    // TODO Refact this method, equals to fillForm from CRMUsersManagementSteps
    public function fillLoginForm($user)
    {
        $I = $this;
        $I->fillField('LoginForm[username]', $user['UserRecord[username]']);
        $I->fillField('LoginForm[password]', $user['UserRecord[password]']);
    }
    
    public function submitLoginForm()
    {
        $I = $this;
        $I->click('button[type=submit]');
        $I->wait(1);
    }
    
    public function seeIamAtHomepage()
    {
        $I = $this;
        $I->seeCurrentUrlEquals('/');
    }
    
    public function seeUsername($user)
    {
        $I = $this;
        $I->see($user['UserRecord[username]']);
    }
    
    public function dontSeeUsername($user)
    {
        $I = $this;
        $I->dontSee($user['UserRecord[username]']);
    }
}
