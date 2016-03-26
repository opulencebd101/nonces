<?php

namespace RouvenHurling\Nonces;

/**
 * Class Config
 * @package RouvenHurling\Nonces
 */
class Config implements ConfigInterface
{

    /**
     * @var int
     */
    private static $lifespan = 86400;
    /**
     * @var string
     */
    private static $algorithm = 'md5';
    /**
     * @var string
     */
    private static $salt;
    /**
     * @var string
     */
    private static $sessionToken;
    /**
     * @var int
     */
    private static $userId;

    /**
     * @return int
     */
    public function getLifespan()
    {
        return self::$lifespan;
    }

    /**
     * @param int $lifespan
     */
    public static function setLifespan($lifespan)
    {
        self::$lifespan = (int)$lifespan;
    }

    /**
     * @return string
     */
    public function getAlgorithm()
    {
        return self::$algorithm;
    }

    /**
     * @param string $algorithm
     *
     * @return bool|void
     */
    public static function setAlgorithm($algorithm)
    {
        if ( ! in_array($algorithm, hash_algos())) {
            return false;
        }

        self::$algorithm = (string)$algorithm;
    }


    /**
     * @return string
     */
    public function getSalt()
    {
        return self::$salt;
    }

    /**
     * @param string $salt
     */
    public static function setSalt($salt)
    {
        self::$salt = (string)$salt;
    }

    /**
     * @return string
     */
    public function getSessionToken()
    {
        return self::$sessionToken;
    }

    /**
     * @param string $sessionToken
     */
    public static function setSessionToken($sessionToken)
    {
        self::$sessionToken = (string)$sessionToken;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return self::$userId;
    }

    /**
     * @param int $userId
     */
    public static function setUserId($userId)
    {
        self::$userId = (int)$userId;
    }

}