<?php 
$I = new \Step\Acceptance\CRMUsersManagementSteps($scenario);
$I->wantTo('register two Users in database');

$I->skipCloud9PreviewPage();

$I->amInListUsersUi();
$I->clickOnRegisterNewUserButton();
$I->seeIamInAddUserUi();
$first_user = $I->imagineUser();
$I->fillUserDataForm($first_user);
$I->submitUserDataForm();
$I->seeIamInViewUserUi();

$I->amInListUsersUi();
$I->seeUserInList($first_user);

$I->clickOnRegisterNewUserButton();
$I->seeIamInAddUserUi();
$second_user = $I->imagineUser();
$I->fillUserDataForm($second_user);
$I->submitUserDataForm();
$I->seeIamInViewUserUi();

$I->amInListUsersUi();
$I->seeUserInList($first_user);
$I->seeUserInList($second_user);
