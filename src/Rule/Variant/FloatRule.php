<?php

namespace Gerfey\Mapper\Rule\Variant;

use Gerfey\Mapper\Rule\RuleMapperInterface;

class FloatRule implements RuleMapperInterface
{

    public function getName(): string
    {
        return 'float';
    }

    public function validation($value, $params = []): bool
    {
        return is_float($value);
    }
}