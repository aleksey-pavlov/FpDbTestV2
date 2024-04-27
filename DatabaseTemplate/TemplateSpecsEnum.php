<?php

namespace FpDbTest\DatabaseTemplate;

use FpDbTest\DatabaseTemplate\SpecInterface;

enum TemplateSpecsEnum: string
{
    case Decimal    = '?d';
    case Float      = '?f';
    case Array      = '?a';
    case Identifier = '?#';
    case Mixed      = '?';
    case Condition  = '{[^{}]+\}';

    public function asRegex()
    {
        return '/\\' . $this->value . '/';
    }

    public function asTpl()
    {
        return '\\' . $this->value;
    }

    public function asClassCast(): SpecInterface
    {
        $className = 'FpDbTest\\DatabaseTemplate\\' . $this->name . 'Spec';
        return new $className;
    }
}