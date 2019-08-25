<?php

namespace Gerfey\Mapper\Rule\Variant;

use Gerfey\Mapper\Rule\RuleMapperInterface;

class IpRule implements RuleMapperInterface
{

    public function getName(): string
    {
        return 'ip';
    }

    public function validation($value, $params = []): bool
    {
        if (filter_var($value, FILTER_VALIDATE_IP) === false) {
            return false;
        }
        return true;
    }
}