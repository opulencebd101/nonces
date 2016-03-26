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
    public function setLifespan($lifespan)
    {
        $this->lifespan = (int)$lifespan;

        return $this;
    }

    /**
     * @param string $algorithm
     *
     * @return $this
     */
    public function setAlgorithm($algorithm)
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
    public function setSalt($salt)
    {
        $this->salt = (string)$salt;

        return $this;
    }

    /**
     * @param string $sessionToken
     *
     * @return $this
     */
    public function setSessionToken($sessionToken)
    {
        $this->sessionToken = (string)$sessionToken;

        return $this;
    }

    /**
     * @param int $userId
     *
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = (int)$userId;

        return $this;
    }

}