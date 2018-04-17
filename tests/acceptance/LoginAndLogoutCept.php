<?php 
$I = new \Step\Acceptance\CRMUsersManagementSteps($scenario);
$I->wantTo('check that login and logout work');

$I->skipCloud9PreviewPage();

$I->amGoingTo('Register new user');

$I->amInListUsersUi();
$I->clickOnRegisterNewUserButton();
$I->seeIamInAddUserUi();
$user = $I->imagineUser();
$I->fillUserDataForm($user);
$I->submitUserDataForm();

$I = new \Step\Acceptance\CRMUserSteps($scenario);
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

$I->amGoingTo('logout from arbitrary page');
$I->amInQueryCustomerUi();
$I->click('logout');

$I->seeIamAtHomepage();
$I->dontSeeUsername($user);
$I->dontSeeLink('logout');
$I->seeLink('login');
