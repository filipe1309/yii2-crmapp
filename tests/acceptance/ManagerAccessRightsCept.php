<?php 
$I = new \Step\Acceptance\CRMOperatorSteps($scenario);
$I->wantTo('Check Manager-level access rights in case of usual CRM Operator');

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
$I->see('Forbidden');

$I->amOnPage('/users/view');
$I->see('Forbidden');

$I->amOnPage('/users/create');
$I->see('Forbidden');

$I->logout();

$I = new \Step\Acceptance\CRMServicesManagementSteps($scenario);
$I->wantTo('Check Manager-level access rights for Services management');

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
$I->see('Forbidden');

$I->amOnPage('/users/view');
$I->see('Forbidden');

$I->amOnPage('/users/create');
$I->see('Forbidden');
