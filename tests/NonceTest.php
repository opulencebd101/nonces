<?php

namespace RouvenHurling\Nonces;

function time($setTime = false)
{
    static $time;
    if ($setTime) {
        $time = $setTime;
    }

    return $time;
}

class NonceTest extends \PHPUnit_Framework_TestCase
{

    static $time = 1458891857;
    static $nonce = '826e26509a';

    public function setUp()
    {
        time(self::$time);
    }

    public function testCreation()
    {
        $nonce = new Nonce();

        $this->assertEquals(self::$nonce, (string)$nonce, 'String casting generation');

        $nonce = $nonce->generate();

        $this->assertEquals(self::$nonce, $nonce, 'Basic Nonce generation');
    }

    public function testVerification()
    {
        $nonce = new Nonce();

        $this->assertFalse($nonce->verify(''), 'Empty Nonce');

        $this->assertEquals(1, $nonce->verify(self::$nonce), 'Nonce less than 12 hours old');

        time(self::$time + 3600 * 12);

        $this->assertEquals(2, $nonce->verify(self::$nonce), 'Nonce less than 24 hours old');

        time(self::$time + 3600 * 24);

        $this->assertFalse($nonce->verify(self::$nonce), 'Nonce older than 24 hours');
    }

    static $userId = 1;
    static $userNonce = '32300ab40b';

    public function testUserSpecificCreation()
    {
        $nonce = new Nonce();
        $nonce = $nonce->setUserId(self::$userId)->generate();

        $this->assertNotEquals(self::$nonce, $nonce, 'User Nonce is different than basic Nonce');
        $this->assertEquals(self::$userNonce, $nonce, 'User Nonce is as expected');

        $nonce2 = new Nonce();
        $nonce2 = $nonce2->setUserId(self::$userId + 1)->generate();

        $this->assertNotEquals($nonce, $nonce2, 'User Nonce is different than User 2 Nonce');
    }

    static $sessionToken = 'session56f5235017cfc1.67463146';
    static $sessionNonce = '9bd1d4a13c';

    public function testSessionSpecificNonce()
    {
        $nonce = new Nonce();
        $nonce = $nonce->setSessionToken(self::$sessionToken)->generate();

        $this->assertNotEquals(self::$nonce, $nonce, 'Session Nonce is different than basic Nonce');
        $this->assertEquals(self::$sessionNonce, $nonce, 'Session Nonce is as expected');

        $nonce2 = new Nonce();
        $nonce2 = $nonce2->setSessionToken(uniqid('session', true))->generate();

        $this->assertNotEquals($nonce, $nonce2, 'Session Nonce is different than Session 2 Nonce');
    }

    static $salt = '6Op?ql<.n$mfX-t>}vHhNy([Z}P.gEhUj_r))U#ETbMxshr{YyZ7:~J,SW()``3E[NAzWO~7_k21xJ|Plvn/,Zz%=,jgf/9R|3}DI-1hIwMDi4OyjTT$S)J^;WOVe6&s';
    static $saltNonce = '43461ff9b1';

    public function testSaltCreation()
    {
        $nonce = new Nonce();
        $nonce = $nonce->setSalt(self::$salt)->generate();

        $this->assertNotEquals(self::$nonce, $nonce, 'Salt Nonce is different than basic Nonce');
        $this->assertEquals(self::$saltNonce, $nonce, 'Salt Nonce is as expected');

        $nonce2 = new Nonce();
        $nonce2 = $nonce2->setSalt(openssl_random_pseudo_bytes(64))->generate();

        $this->assertNotEquals($nonce, $nonce2, 'Salt Nonce is different than Salt 2 Nonce');
    }

    static $action = 'phpunit-testing';
    static $actionNonce = '7668c4925d';

    public function testActionCreation()
    {
        $nonce = new Nonce(self::$action);
        $nonce = $nonce->generate();

        $this->assertNotEquals(self::$nonce, $nonce, 'Action Nonce is different than basic Nonce');
        $this->assertEquals(self::$actionNonce, $nonce, 'Action Nonce is as expected');

        $nonce2 = new Nonce('phpunit-nonce2');
        $nonce2 = $nonce2->generate();

        $this->assertNotEquals($nonce, $nonce2, 'Action Nonce is different than Action 2 Nonce');
    }

    static $everythingNonce = '682c250ccb';

    public function testCombinedCreation()
    {
        $nonce = new Nonce(self::$action);
        $nonce = $nonce
            ->setSalt(self::$salt)
            ->setSessionToken(self::$sessionToken)
            ->setUserId(self::$userId)
            ->generate();

        $this->assertNotEquals(self::$nonce, $nonce);
        $this->assertNotEquals(self::$actionNonce, $nonce);
        $this->assertNotEquals(self::$saltNonce, $nonce);
        $this->assertNotEquals(self::$sessionNonce, $nonce);
        $this->assertNotEquals(self::$userNonce, $nonce);
        $this->assertEquals(self::$everythingNonce, $nonce);
    }

}
