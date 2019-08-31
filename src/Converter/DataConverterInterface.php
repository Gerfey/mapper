<?php

namespace Gerfey\Mapper\Converter;

use Gerfey\Mapper\Rule\RuleMapperInterface;

interface DataConverterInterface
{
    public static function convert(string $value, string $type, RuleMapperInterface $rule);
}