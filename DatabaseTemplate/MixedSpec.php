<?php

namespace FpDbTest\DatabaseTemplate;

use Exception;

class MixedSpec implements SpecInterface
{
    static function prepare($val)
    {
        if (is_int($val) || is_float($val)) {
            return $val;
        }

        if (is_bool($val)) {
            return (int)$val;
        }

        if (is_string($val)) {
            return "'{$val}'";
        }

        if (is_null($val)) {
            return 'NULL';
        }

        throw new Exception("Input value type must be int, float, bool, string or null");
    }
}
