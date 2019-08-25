<?php

namespace Gerfey\Mapper\Rule\Variant;

use Gerfey\Mapper\Rule\RuleMapperInterface;

class ArrayRule implements RuleMapperInterface
{

    public function getName(): string
    {
        return 'array';
    }

    public function validation($value, $params = []): bool
    {
        return is_array($value);
    }
}