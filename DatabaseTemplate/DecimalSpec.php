<?php

namespace FpDbTest\DatabaseTemplate;

class DecimalSpec implements SpecInterface
{
    static function prepare($val)
    {
        if (is_null($val)) {
            return 'NULL';
        }

        return (int)$val;
    }
}
