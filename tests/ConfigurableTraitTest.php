<?php

namespace RouvenHurling\Nonces;

class ConfigurableTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigurableTrait
     */
    private $mock;

    public function setUp()
    {
        $this->mock               = $this->getMockForTrait(__NAMESPACE__ . '\ConfigurableTrait');
        $this->mock->lifespan     = null;
        $this->mock->algorithm    = null;
        $this->mock->salt         = null;
        $this->mock->sessionToken = null;
        $this->mock->userId       = null;
    }

    public function testSettingLifespan()
    {
        $this->assertNotEquals(1, $this->mock->lifespan);

        $this->mock->setLifespan(1);
        $this->assertEquals(1, $this->mock->lifespan);
    }

    public function testSettingAlgorithm()
    {
        $this->assertNotEquals('md5', $this->mock->algorithm);

        $this->mock->setAlgorithm('md5');
        $this->assertEquals('md5', $this->mock->algorithm);

        $set = $this->mock->setAlgorithm('nonexistent');
        $this->assertFalse($set);
        $this->assertEquals('md5', $this->mock->algorithm);
    }

    public function testSettingSalt()
    {
        $this->assertNotEquals('salt', $this->mock->salt);

        $this->mock->setSalt('salt');
        $this->assertEquals('salt', $this->mock->salt);
    }

    public function testSettingSessionToken()
    {
        $this->assertNotEquals('token', $this->mock->sessionToken);

        $this->mock->setSessionToken('token');
        $this->assertEquals('token', $this->mock->sessionToken);
    }

    public function testSettingUserId()
    {
        $this->assertNotEquals(1, $this->mock->userId);
        $this->mock->setUserId(1);
        $this->assertEquals(1, $this->mock->userId);
    }

}
