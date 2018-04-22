<?php 
$I = new \Step\Acceptance\CRMServicesManagementSteps($scenario);
$I->wantTo('delete existing Service record');

$I->amInListServicesUi();
$I->clickOnRegisterNewServiceButton();
$I->seeIAmInAddServiceUi();
$first_service = $I->imagineService();
$I->fillServiceDataForm($first_service);
$I->submitServiceDataForm();

$I->seeIamInViewServiceUi();

$I->amInListServicesUi();
$I->seeServiceInList($first_service);
$I->seeDeleteButtonBesideService($first_service);
$I->clickDeleteButtonBesideService($first_service);

$I->seeDeletionConfirmation();
$I->cancelDeletion();

$I->amInListServicesUi();
$I->seeServiceInList($first_service);

$I->wantTo('check that if I confirm deletion then application deletes Service');

$I->clickDeleteButtonBesideService($first_service);
$I->seeDeletionConfirmation();
$I->confirmDeletion();

$I->seeIAmInListServicesUi();
// Fix to avoid StaleElementReferenceException od .grid-view class
$I->amInListServicesUi();
//$I->reloadPage();
$I->dontSeeServiceInList($first_service);
