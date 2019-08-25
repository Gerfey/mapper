<?php

namespace Gerfey\Mapper\Rule\Variant;

use Gerfey\Mapper\Rule\RuleMapperInterface;

class LimitRule implements RuleMapperInterface
{

    public function getName(): string
    {
        return 'limit';
    }

    public function validation($value, $params = []): bool
    {
        if ($value < $params[0] || $value > $params[1]) {
            return false;
        }
        return true;
    }
}