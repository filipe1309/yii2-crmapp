<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('See that landing page is up');

$I->skipCloud9PreviewPage();

$I->amOnPage('/');
$I->see('Our CRM');
