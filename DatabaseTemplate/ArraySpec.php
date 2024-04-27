<?php

namespace FpDbTest\DatabaseTemplate;

use Exception;

class ArraySpec implements SpecInterface
{
    static function prepare($val = [])
    {
        if (!is_array($val)) {
            throw new Exception("Input value must be array");
        }

        if (array_is_list($val)) {
            array_walk($val, fn ($v) => MixedSpec::prepare($v));
            return implode(', ', $val);
        }

        $pair = '';
        foreach ($val as $k => $v) {

            $v = MixedSpec::prepare($v);

            $pair .= "`{$k}` = {$v}, ";
        }

        return rtrim($pair, ', ');
    }
}
