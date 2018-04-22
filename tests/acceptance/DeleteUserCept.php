<?php 
$I = new \Step\Acceptance\CRMUsersManagementSteps($scenario);
$I->wantTo('delete existing User record');

$I->amInListUsersUi();
$I->clickOnRegisterNewUserButton();
$I->seeIAmInAddUserUi();
$first_user = $I->imagineUser();
$I->fillUserDataForm($first_user);
$I->submitUserDataForm();

$I->seeIamInViewUserUi();

$I->amInListUsersUi();
$I->seeUserInList($first_user);
$I->seeDeleteButtonBesideUser($first_user);
$I->clickDeleteButtonBesideUser($first_user);

$I->seeDeletionConfirmation();
$I->cancelDeletion();

$I->amInListUsersUi();
$I->seeUserInList($first_user);

$I->wantTo('check that if I confirm deletion then application deletes User');

$I->clickDeleteButtonBesideUser($first_user);
$I->seeDeletionConfirmation();
$I->confirmDeletion();

$I->seeIAmInListUsersUi();
// Fix to avoid StaleElementReferenceException od .grid-view class
$I->amInListUsersUi();
//$I->reloadPage();
$I->dontSeeUserInList($first_user);
