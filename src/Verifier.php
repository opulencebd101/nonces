<?php

namespace RouvenHurling\Nonces;

class Verifier implements VerifierInterface, ConfigurableInterface
{

    use GeneratorTrait, ConfigurableTrait;

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
     * Verifier constructor.
     *
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config = null)
    {
        if (is_null($config)) {
            $config = new Config();
        }

        $this->lifespan     = $config->getLifespan();
        $this->algorithm    = $config->getAlgorithm();
        $this->salt         = $config->getSalt();
        $this->sessionToken = $config->getSessionToken();
        $this->userId       = $config->getUserId();
    }

    /**
     * @param string $nonce
     * @param string|int $action
     *
     * @return bool|int
     */
    public function verify($nonce, $action = -1)
    {
        $this->action = $action;
        $nonce        = (string)$nonce;

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

}