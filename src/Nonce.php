<?php

namespace RouvenHurling\Nonces;

/**
 * Class Nonce
 * @package RouvenHurling\Nonces
 */
class Nonce implements NonceInterface, ConfigurableInterface
{

    use ConfigurableTrait;

    /**
     * @var string|int
     */
    private $action;
    /**
     * @var string
     */
    private $algorithm = 'md5';
    /**
     * @var int
     */
    private $lifespan = 86400;
    /**
     * @var string
     */
    private $salt;
    /**
     * @var string
     */
    private $sessionToken;
    /**
     * @var int
     */
    private $userId;

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
     * Generates the nonce string
     *
     * @return string
     */
    function generate()
    {
        return $this->hash($this->data());
    }

    /**
     * @param string $nonce Nonce to verify
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
        return substr(hash_hmac($this->algorithm, $data, $this->salt), -12, 10);
    }

    /**
     * @param int $tickAdjust
     *
     * @return string
     */
    protected function data($tickAdjust = 0)
    {
        $data = ($this->tick() + $tickAdjust) . '|' . $this->action;

        if ($this->userId) {
            $data .= '|' . $this->userId;
        }
        if ($this->sessionToken) {
            $data .= '|' . $this->sessionToken;
        }

        return $data;
    }

    /**
     * @return float
     */
    protected function tick()
    {
        return ceil(time() / ($this->lifespan / 2));
    }

}