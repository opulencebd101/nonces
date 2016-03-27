<?php

namespace RouvenHurling\Nonces;

class VerifierTest extends \PHPUnit_Framework_TestCase
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

    public function testVerification()
    {
        $verifier = new Verifier();

        $this->assertFalse($verifier->verify(''), 'Empty Nonce');

        $this->assertEquals(1, $verifier->verify(self::$nonce), 'Nonce less than 12 hours old');

        time(self::$time + 3600 * 12);

        $this->assertEquals(2, $verifier->verify(self::$nonce), 'Nonce less than 24 hours old');

        time(self::$time + 3600 * 24);

        $this->assertFalse($verifier->verify(self::$nonce), 'Nonce older than 24 hours');
    }

    public static function tearDownAfterClass()
    {
        Config::setLifespan(86400);
        Config::setSalt(null);
        Config::setUserId(null);
        Config::setSessionToken(null);
    }

}
