<?php 
$I = new \Step\Acceptance\CRMServicesManagementSteps($scenario);
$I->wantTo('register two Services in database');

$I->amInListServicesUi();
$I->clickOnRegisterNewServiceButton();
$I->seeIamInAddServiceUi();
$first_service = $I->imagineService();
$I->fillServiceDataForm($first_service);
$I->submitServiceDataForm();
$I->seeIamInViewServiceUi();

$I->amInListServicesUi();
$I->seeServiceInList($first_service);

$I->clickOnRegisterNewServiceButton();
$I->seeIamInAddServiceUi();
$second_service = $I->imagineService();
$I->fillServiceDataForm($second_service);
$I->submitServiceDataForm();
$I->seeIamInViewServiceUi();

$I->amInListServicesUi();
$I->seeServiceInList($first_service);
$I->seeServiceInList($second_service);
