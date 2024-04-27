<?php

namespace FpDbTest\DatabaseTemplate;

use Exception;

class IdentifierSpec implements SpecInterface
{
    static function prepare($val)
    {
        if (is_array($val)) {
            return '`' . implode('`, `', $val) . '`';
        }

        if (is_string($val)) {
            return "`{$val}`";
        }

        throw new Exception("Input value must be string or array[string]");
    }
}
