<?php 
$I = new \Step\Acceptance\CRMUsersManagementSteps($scenario);
$I->wantTo('Check Admin-level access rights');

$I->skipCloud9PreviewPage();

// Customers

$I->amOnPage('/customers/index');
$I->dontSee('Forbidden');

$I->amOnPage('/customers/query');
$I->dontSee('Forbidden');

$I->amOnPage('/customers/add');
$I->dontSee('Forbidden');

// Services

$I->amOnPage('/services/index');
$I->dontSee('Forbidden');

$I->amOnPage('/services/view');
$I->dontSee('Forbidden');

$I->amOnPage('/services/create');
$I->dontSee('Forbidden');

// Users

$I->amOnPage('/users/index');
$I->dontSee('Forbidden');

$I->amOnPage('/users/view');
$I->dontSee('Forbidden');

$I->amOnPage('/users/create');
$I->dontSee('Forbidden');
