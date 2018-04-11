<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

   /**
    * Define custom actions here
    */
    
    public function skipCloud9PreviewPage()
    {
        // Skip Cloud9 Preview Page
        $I = $this;
        $I->amOnPage('/');
        $I->executeJs("document.cookie = 'c9.live.user.click-through=ok;'");
        $I->reloadPage();
    }
    
    public function seeContentIsLong($content, $trigger_length = 100)
    {
        $this->assertGreaterThen($trigger_length, strlen($content));
    }
}
