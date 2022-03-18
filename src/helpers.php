<?php

use Jmerilainen\Clsp\Clsp;

if (! function_exists('clsp')) {
    function clsp(string $defaults = '')
    {
        return Clsp::make($defaults);
    }
}
