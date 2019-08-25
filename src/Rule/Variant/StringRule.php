<?php

namespace Gerfey\Mapper\Rule\Variant;

use Gerfey\Mapper\Rule\RuleMapperInterface;

class StringRule implements RuleMapperInterface
{

    public function getName(): string
    {
        return 'string';
    }

    public function validation($value, $params = []): bool
    {
        return is_string($value);
    }
}