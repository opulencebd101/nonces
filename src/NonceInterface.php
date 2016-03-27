<?php

namespace RouvenHurling\Nonces;

interface NonceInterface
{

    public function __toString();

    public function generate();

}