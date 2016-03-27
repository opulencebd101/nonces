<?php

namespace RouvenHurling\Nonces;

trait GeneratorTrait
{
    
    /**
     * @param string $data
     *
     * @return string
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