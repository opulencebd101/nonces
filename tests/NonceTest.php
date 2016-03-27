<?php

namespace RouvenHurling\Nonces;

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

    public static function tearDownAfterClass()
    {
        Config::setLifespan(86400);
        Config::setSalt(null);
        Config::setUserId(null);
        Config::setSessionToken(null);
    }

}
