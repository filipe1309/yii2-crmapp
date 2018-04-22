<?php 
$I = new \Step\Acceptance\CRMUserSteps($scenario);
$I->wantTo('see wether user documentation is accessible');

$I->amOnPage('/site/docs');
$I->see('Documentation', 'h1');
$I->seeLargeBodyOfText();
