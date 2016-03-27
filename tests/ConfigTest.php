<?php

namespace RouvenHurling\Nonces;

class ConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Config
     */
    private static $config;
    private static $originalConfig = [];

    public static function setUpBeforeClass()
    {
        self::$config         = new Config();
        self::$originalConfig = [
            'setLifespan'     => self::$config->getLifespan(),
            'setAlgorithm'    => self::$config->getAlgorithm(),
            'setSalt'         => self::$config->getSalt(),
            'setSessionToken' => self::$config->getSessionToken(),
            'setUserId'       => self::$config->getUserId(),
        ];
    }

    public function testSettingLifespan()
    {
        $this->assertNotEquals(1, self::$config->getLifespan());

        Config::setLifespan(1);
        $this->assertEquals(1, self::$config->getLifespan());
    }

    public function testSettingAlgorithm()
    {
        $this->assertNotEquals('sha256', self::$config->getAlgorithm());

        Config::setAlgorithm('sha256');
        $this->assertEquals('sha256', self::$config->getAlgorithm());

        $set = Config::setAlgorithm('nonexistent');
        $this->assertFalse($set);
        $this->assertEquals('sha256', self::$config->getAlgorithm());
    }

    public function testSettingSalt()
    {
        $this->assertNotEquals('salt', self::$config->getSalt());

        Config::setSalt('salt');
        $this->assertEquals('salt', self::$config->getSalt());
    }

    public function testSettingSessionToken()
    {
        $this->assertNotEquals('token', self::$config->getSessionToken());

        Config::setSessionToken('token');
        $this->assertEquals('token', self::$config->getSessionToken());
    }

    public function testSettingUserId()
    {
        $this->assertNotEquals(1, self::$config->getUserId());
        Config::setUserId(1);
        $this->assertEquals(1, self::$config->getUserId());
    }

    public static function tearDownAfterClass()
    {
        foreach (self::$originalConfig as $func => $value) {
            call_user_func_array([Config::class, $func], [$value]);
        }
    }

}
