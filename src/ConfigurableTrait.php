<?php

namespace RouvenHurling\Nonces;

/**
 * Class ConfigurableTrait
 * @package RouvenHurling\Nonces
 */
trait ConfigurableTrait
{

    /**
     * @param string $lifespan
     *
     * @return $this
     */
    function setLifespan($lifespan)
    {
        $this->lifespan = (int)$lifespan;

        return $this;
    }

    /**
     * @param string $algorithm
     *
     * @return $this
     */
    function setAlgorithm($algorithm)
    {
        if ( ! in_array($algorithm, hash_algos())) {
            return false;
        }

        $this->algorithm = (string)$algorithm;

        return $this;
    }

    /**
     * @param string $salt
     *
     * @return $this
     */
    function setSalt($salt)
    {
        $this->salt = (string)$salt;

        return $this;
    }

    /**
     * @param string $sessionToken
     *
     * @return $this
     */
    function setSessionToken($sessionToken)
    {
        $this->sessionToken = (string)$sessionToken;

        return $this;
    }

    /**
     * @param int $userId
     *
     * @return $this
     */
    function setUserId($userId)
    {
        $this->userId = (int)$userId;

        return $this;
    }

}