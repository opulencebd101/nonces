<?php

namespace RouvenHurling\Nonces;

/**
 * Interface ConfigurableInterface
 * @package RouvenHurling\Nonces
 */
interface ConfigurableInterface
{

    /**
     * @param int $lifespan
     *
     * @return $this
     */
    public function setLifespan($lifespan);

    /**
     * @param string $algorithm
     *
     * @return $this
     */
    public function setAlgorithm($algorithm);

    /**
     * @param string $salt
     *
     * @return $this
     */
    public function setSalt($salt);

    /**
     * @param string $sessionToken
     *
     * @return $this
     */
    public function setSessionToken($sessionToken);

    /**
     * @param int $userId
     *
     * @return $this
     */
    public function setUserId($userId);

}