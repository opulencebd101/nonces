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
    static $nonce = 'c9b9978685';

    public static function setUpBeforeClass()
    {
        Config::setLifespan(86400);
        Config::setSalt('salt');
        Config::setUserId(1);
        Config::setSessionToken('session-1');
    }

    public function setUp()
    {
        time(self::$time);
    }

    public function testCreation()
    {
        $nonce = new Nonce();
        $this->assertEquals(self::$nonce, $nonce->generate());
        $this->assertEquals(self::$nonce, (string)$nonce);
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

    public static function tearDownAfterClass()
    {
        Config::setLifespan(86400);
        Config::setSalt(null);
        Config::setUserId(null);
        Config::setSessionToken(null);
    }

}
