<?php

namespace {
    require 'vendor/autoload.php';
}

namespace RouvenHurling\Nonces {

    function time($setTime = false)
    {
        static $time;
        if ($setTime) {
            $time = $setTime;
        }

        return $time;
    }

}