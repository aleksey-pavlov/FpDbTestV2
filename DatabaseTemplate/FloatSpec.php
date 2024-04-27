<?php

namespace FpDbTest\DatabaseTemplate;

class FloatSpec implements SpecInterface
{
    static function prepare($val)
    {
        if (is_null($val)) {
            return 'NULL';
        }

        return (float)$val;
    }
}
