<?php

namespace Gerfey\Mapper\Rule\Variant;

use Gerfey\Mapper\Rule\RuleMapperInterface;

class LengthRule implements RuleMapperInterface
{

    public function getName(): string
    {
        return 'length';
    }

    public function validation($value, $params = []): bool
    {
        $strlen = mb_strlen($value);
        if ($strlen > $params[0]) {
            return false;
        }
        return true;
    }
}