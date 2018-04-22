<?php 
$I = new \Step\Acceptance\CRMUsersManagementSteps($scenario);
$I->wantTo('check that login and logout work');

$I->amGoingTo('Register new user');

$I->amInListUsersUi();
$I->clickOnRegisterNewUserButton();
$I->seeIamInAddUserUi();
$user = $I->imagineUser();
$I->fillUserDataForm($user);
$I->submitUserDataForm();

$I->logout();

$I = new \Step\Acceptance\CRMGuestSteps($scenario);
$I->amGoingTo('login');

$I->seeLink('login');
$I->click('login');
$I->seeIamInLoginFormUi();
$I->fillLoginForm($user);
$I->submitLoginForm();

$I->seeIamAtHomepage();
$I->dontSee('login');

$I->seeUsername($user);
$I->seeLink('logout');

$I->logout();

$I->seeIamAtHomepage();
$I->dontSeeUsername($user);
$I->dontSeeLink('logout');
$I->seeLink('login');
