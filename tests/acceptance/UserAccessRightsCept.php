<?php 
$I = new \Step\Acceptance\CRMUserSteps($scenario);
$I->wantTo('Check User-level access rights');

// Customers

$I->amOnPage('/customers/index');
$I->dontSee('Forbidden');

$I->amOnPage('/customers/query');
$I->dontSee('Forbidden');

$I->amOnPage('/customers/add');
$I->see('Forbidden');

// Services

$I->amOnPage('/services/index');
$I->see('Forbidden');

$I->amOnPage('/services/view');
$I->see('Forbidden');

$I->amOnPage('/services/create');
$I->see('Forbidden');

// Users

$I->amOnPage('/users/index');
$I->see('Forbidden');

$I->amOnPage('/users/view');
$I->see('Forbidden');

$I->amOnPage('/users/create');
$I->see('Forbidden');
