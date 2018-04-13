<?php 
$I = new \Step\Acceptance\CRMUsersManagementSteps($scenario);
$I->wantTo('register two Users in database');

$I->skipCloud9PreviewPage();

$I->amInListUsersUi();
$I->clickOnRegisterNewServiceButton();
$I->seeIamInAddServiceUi();
$first_service = $I->imagineService();
$I->fillServiceDataForm($first_service);
$I->submitServiceDataForm();
$I->seeIamInViewServiceUi();

$I->amInListUsersUi();
$I->seeServiceInList($first_service);

$I->clickOnRegisterNewServiceButton();
$I->seeIamInAddServiceUi();
$second_service = $I->imagineService();
$I->fillServiceDataForm($second_service);
$I->submitServiceDataForm();
$I->seeIamInViewServiceUi();

$I->amInListUsersUi();
$I->seeServiceInList($first_service);
$I->seeServiceInList($second_service);
