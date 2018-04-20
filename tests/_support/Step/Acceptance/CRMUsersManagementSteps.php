<?php
namespace Step\Acceptance;

class CRMUsersManagementSteps extends CRMGuestSteps
{
    public $username = 'RobAdmin';
    public $password = 'Imitate #14th symptom of apathy';
    
    const SERVICES_LIST_SELECTOR = '.grid-view';
    
    public function amInListUsersUi()
    {
        $I = $this;
        $I->amOnPage('/users');
    }
    
    public function clickOnRegisterNewUserButton()
    {
        $I = $this;
        $I->click('Create');
    }
    
    public function seeIamInAddUserUi()
    {
        $I = $this;
        $I->seeCurrentUrlEquals('/web_app_dev_yii2_php/yii2-crmapp/web/users/create');
    }
    
    public function imagineUser()
    {
        $faker = \Faker\Factory::create();
        return [
            'UserRecord[username]' => $faker->userName,
            'UserRecord[password]' => md5(time())
        ];
    }
    
    public function fillUserDataForm($fieldsData)
    {
        $I = $this;
        foreach ($fieldsData as $key => $value)
            $I->fillField($key, $value);
    }
    
    public function submitUserDataForm()
    {
        $I = $this;
        $I->click('button[type=submit]');
        $I->wait(1);
    }
    
    public function seeIamInViewUserUi()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('~users/view~'); // regexp
        $I->see('Update');
        $I->see('Delete');
    }
    
    public function seeUserInList($user_data)
    {
        $I = $this;
        $I->see($user_data['UserRecord[username]'], self::SERVICES_LIST_SELECTOR);
    }
    
    public function seeEditButtonBesideUser($user_data)
    {
        $I = $this;
        $xpath = $this->makeXpathForButtonNearUserName(
            $user_data['UserRecord[username]'],
            'Update'
        );
        $I->seeElement($xpath);
    }
    
    public function makeXpathForButtonNearUserName(
        $user_name, 
        $button_title
    ){
        $xpath = sprintf('//td[text()="%s"]/following-sibling::td/a[@title="%s"]',
            $user_name,
            $button_title
        );
        return $xpath;
    }
    
    public function clickEditButtonBesideUser($user_data)
    {
        $I = $this;
        $xpath = $this->makeXpathForButtonNearUserName(
            $user_data['UserRecord[username]'],
            'Update'
        );
        $I->click($xpath);
    }
    
    public function seeEditUserUi()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('~users/update~');
        $I->see('Update');
    }
    
    public function seeIAmInListUsersUi()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('/users/'); // regexp
        $I->seeElement(self::SERVICES_LIST_SELECTOR);
    }
    
    public function dontSeeUserInList($user_data)
    {
        $I = $this;
        $I->dontSee($user_data['UserRecord[username]'],
            self::SERVICES_LIST_SELECTOR
        );
    }
    
    public function seeDeleteButtonBesideUser($user_data)
    {
        $I = $this;
        $xpath = $this->makeXpathForButtonNearUserName(
            $user_data['UserRecord[username]'],
            'Delete'
        );
        $I->seeElement($xpath);
    }
    
    public function clickDeleteButtonBesideUser($user_data)
    {
        $I = $this;
        $xpath = $this->makeXpathForButtonNearUserName(
            $user_data['UserRecord[username]'],
            'Delete'
        );
        $I->click($xpath);
        $I->wait(1);
    }
    
    // TODO Remove duplication
    public function seeDeletionConfirmation()
    {
        $I = $this;
        $I->seeInPopup('delete');
    }
    
    // TODO Remove duplication
    public function cancelDeletion()
    {
        $I = $this;
        $I->cancelPopup();
    }
    
    // TODO Remove duplication
    public function confirmDeletion()
    {
        $I = $this;
        $I->acceptPopup();
    }
}
