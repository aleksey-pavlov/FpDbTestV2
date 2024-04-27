<?php

namespace FpDbTest;

use Exception;

use FpDbTest\DatabaseTemplate\TemplateSpecsEnum;

class DatabaseTemplate implements DatabaseTemplateInterface
{
    private const SKIP_CONDITION_SYMBOL = '#';

    private $_fullTplSpecs;

    public function __construct()
    {
        $this->_fullTplSpecs = $this->_fullTplSpecsBuild();
    }

    public function compile(string $tpl = '', array $args = []): string
    {
        if ($countSpecs = preg_match_all("/$this->_fullTplSpecs/i", $tpl, $matches)) {

            if ($countSpecs > count($args)) {
                throw new Exception("Arguments count not compatiable with template");
            }

            for ($i = 0; $i < count($matches[0]); $i++) {

                $match = $matches[0][$i];

                $spec = TemplateSpecsEnum::tryFrom($match);

                if (!$spec) {
                    $block = $this->compile(trim($match, '{}'), array_slice($args, $i));
                    $tpl = str_replace($match, $block, $tpl);
                    continue;
                }

                if ($args[$i] === self::SKIP_CONDITION_SYMBOL) {
                    return '';
                }

                $tpl = preg_replace(
                    $spec->asRegex(),
                    $spec->asClassCast()::prepare($args[$i]),
                    $tpl,
                    1
                );
            }

            return $tpl;
        }
    }

    public function skip(): string
    {
        return self::SKIP_CONDITION_SYMBOL;
    }

    private function _fullTplSpecsBuild()
    {
        return implode(
            '|',
            array_map(fn ($case) => $case->asTpl(), TemplateSpecsEnum::cases())
        );
    }
}
