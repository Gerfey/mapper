<?php

namespace Gerfey\Mapper\Rule\Variant;

use Gerfey\Mapper\Rule\RuleMapperInterface;

class DoubleRule implements RuleMapperInterface
{

    public function getName(): string
    {
        return 'double';
    }

    public function validation($value, $params = []): bool
    {
        return is_double($value);
    }
}