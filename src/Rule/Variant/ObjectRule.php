<?php

namespace Gerfey\Mapper\Rule\Variant;

use Gerfey\Mapper\Rule\RuleMapperInterface;

class ObjectRule implements RuleMapperInterface
{

    public function getName(): string
    {
        return 'object';
    }

    public function validation($value, $params = []): bool
    {
        return is_object($value);
    }
}