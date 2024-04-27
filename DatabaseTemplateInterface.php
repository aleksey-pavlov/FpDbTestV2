<?php

namespace FpDbTest;

interface DatabaseTemplateInterface
{
    function compile(string $tpl, array $args = []): string;

    function skip(): string;
}
