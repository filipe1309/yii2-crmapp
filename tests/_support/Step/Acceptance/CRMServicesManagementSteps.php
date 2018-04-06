<?php
namespace Step\Acceptance;

class CRMServicesManagementSteps extends CRMGuestSteps
{
    const SERVICES_LIST_SELECTOR = '.grid-view';
    
    public function amInListServiceUi()
    {
        $I = $this;
        $I->amOnPage('/services');
    }
    
    public function clickOnRegisterNewServiceButton()
    {
        $I = $this;
        $I->click('Create');
    }
    
    public function seeIamInAddServiceUi()
    {
        $I = $this;
        $I->seeCurrentUrlEquals('/web_app_dev_yii2_php/yii2-crmapp/web/services/create');
    }
    
    public function imagineService()
    {
        $faker = \Faker\Factory::create();
        return [
            'ServiceRecord[name]' => $faker->sentence($words = 3),
            'ServiceRecord[hourly_rate]' => $faker->randomNumber($digits = 2)
        ];
    }
    
    public function fillServiceDataForm($fieldsData)
    {
        $I = $this;
        foreach ($fieldsData as $key => $value)
            $I->fillField($key, $value);
    }
    
    public function submitServiceDataForm()
    {
        $I = $this;
        $I->click('button[type=submit]');
        //$I->wait(1);
    }
    
    public function seeIamInViewServiceUi()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('~services/view~'); // regexp
        $I->see('Update');
        $I->see('Delete');
    }
    
    public function seeServiceInList($service_data)
    {
        $I = $this;
        $I->see($service_data['ServiceRecord[name]'], self::SERVICES_LIST_SELECTOR);
    }
    
    public function seeEditButtonBesideService($service_data)
    {
        $I = $this;
        $xpath = $this->makeXpathForButtonNearServiceName(
            $service_data['ServiceRecord[name]'],
            'Update'
        );
        $I->seeElement($xpath);
    }
    
    public function makeXpathForButtonNearServiceName(
        $service_name, 
        $button_title
    ){
        $xpath = sprintf('//td[text()="%s"]/following-sibling::td/a[@title="%s"]',
            $service_name,
            $button_title
        );
        return $xpath;
    }
    
    public function clickEditButtonBesideService($service_data)
    {
        $I = $this;
        $xpath = $this->makeXpathForButtonNearServiceName(
            $service_data['ServiceRecord[name]'],
            'Update'
        );
        $I->click($xpath);
    }
    
    public function seeEditServiceUi()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('~services/update~');
        $I->see('Update');
    }
    
    public function dontSeeServiceInList($service_data)
    {
        $I = $this;
        $I->dontSee($service_data['ServiceRecord[name]'],
            self::SERVICES_LIST_SELECTOR
        );
    }
}
