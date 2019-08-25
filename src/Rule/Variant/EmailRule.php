<?php

namespace Gerfey\Mapper\Rule\Variant;

use Gerfey\Mapper\Rule\RuleMapperInterface;

class EmailRule implements RuleMapperInterface
{

    public function getName(): string
    {
        return 'email';
    }

    public function validation($value, $params = []): bool
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }
        return true;
    }
}