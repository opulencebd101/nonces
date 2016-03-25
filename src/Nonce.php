<?php

namespace RouvenHurling\Nonces;

/**
 * Class Nonce
 * @package RouvenHurling\Nonces
 */
/**
 * Class Nonce
 * @package RouvenHurling\Nonces
 */
class Nonce
{
    /**
     * @var string
     */
    private $algo;
    /**
     * @var int
     */
    private $lifespan;
    /**
     * @var string
     */
    private $salt;

    /**
     * @var string|int
     */
    private $action;
    /**
     * @var int|bool
     */
    private $userId = false;
    /**
     * @var string|bool
     */
    private $sessionToken = false;

    /**
     * Nonce constructor.
     *
     * @param $action string|int Action string to use in Nonce generation
     * @param $lifespan int Lifespan of seconds for Nonces
     * @param $algo string Algorithm to use with hash_hmac
     */
    public function __construct($action = -1, $lifespan = 86400, $algo = 'md5')
    {
        $this->lifespan = $lifespan;
        $this->algo     = $algo;

        $this->action = $action;

        return $this;
    }

    /**
     * Return nonce string if object is casted to string
     *
     * @return string
     */
    function __toString()
    {
        return $this->generate();
    }

    /**
     * @param $salt
     *
     * @return $this
     */
    function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @param $userId
     *
     * @return $this
     */
    function setUserId($userId)
    {
        $this->userId = (int)$userId;

        return $this;
    }

    /**
     * @param $sessionToken
     *
     * @return $this
     */
    function setSessionToken($sessionToken)
    {
        $this->sessionToken = (string)$sessionToken;

        return $this;
    }

    /**
     * Generates the nonce string
     *
     * @return string
     */
    function generate()
    {
        return $this->hash($this->data());
    }

    /**
     * @param $nonce string Nonce to verify
     *
     * @return bool|int
     */
    function verify($nonce)
    {
        $nonce = (string)$nonce;

        if (empty($nonce)) {
            return false;
        }

        $expected = $this->hash($this->data());
        if (hash_equals($expected, $nonce)) {
            return 1;
        }

        $expected = $this->hash($this->data(-1));
        if (hash_equals($expected, $nonce)) {
            return 2;
        }

        return false;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    protected function hash($data)
    {
        return substr(hash_hmac($this->algo, $data, $this->salt), -12, 10);
    }

    /**
     * @param int $tickAdjust
     *
     * @return string
     */
    protected function data($tickAdjust = 0)
    {
        $data = ($this->tick() + $tickAdjust) . '|' . $this->action;

        if ($this->userId !== false) {
            $data .= '|' . $this->userId;
        }
        if ($this->sessionToken !== false) {
            $data .= '|' . $this->sessionToken;
        }

        return $data;
    }

    /**
     * @return mixed
     */
    protected function tick()
    {
        return ceil(time() / ($this->lifespan / 2));
    }

}