<?php

namespace RouvenHurling\Nonces;

interface VerifierInterface
{

    public function verify($nonce, $action = -1);

}