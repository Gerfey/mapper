<?php

namespace Gerfey\Mapper\Rule\Variant;

use Gerfey\Mapper\Rule\RuleMapperInterface;

class BooleanRule implements RuleMapperInterface
{

    public function getName(): string
    {
        return 'boolean';
    }

    public function validation($value, $params = []): bool
    {
        return is_bool($value);
    }
}