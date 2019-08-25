<?php

namespace Gerfey\Mapper\Rule\Variant;

use Gerfey\Mapper\Rule\RuleMapperInterface;

class IntegerRule implements RuleMapperInterface
{

    public function getName(): string
    {
        return 'integer';
    }

    public function validation($value, $params = []): bool
    {
        return is_integer($value);
    }
}