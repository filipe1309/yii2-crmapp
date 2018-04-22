<?php 
$I = new \Step\Acceptance\CRMGuestSteps($scenario);
$I->wantTo('Check Guest-level access rights');

// Customers

$I->amOnPage('/customers/index');
$I->seeElement('#login-form');

$I->amOnPage('/customers/query');
$I->seeElement('#login-form');

$I->amOnPage('/customers/add');
$I->seeElement('#login-form');

// Services

$I->amOnPage('/services/index');
$I->seeElement('#login-form');

$I->amOnPage('/services/view');
$I->seeElement('#login-form');

$I->amOnPage('/services/create');
$I->seeElement('#login-form');

// Users

$I->amOnPage('/users/index');
$I->seeElement('#login-form');

$I->amOnPage('/users/view');
$I->seeElement('#login-form');

$I->amOnPage('/users/create');
$I->seeElement('#login-form');
