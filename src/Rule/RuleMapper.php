<?php

namespace Gerfey\Mapper\Rule;

use Gerfey\Mapper\Rule\Variant\ArrayRule;
use Gerfey\Mapper\Rule\Variant\BooleanRule;
use Gerfey\Mapper\Rule\Variant\DoubleRule;
use Gerfey\Mapper\Rule\Variant\EmailRule;
use Gerfey\Mapper\Rule\Variant\FloatRule;
use Gerfey\Mapper\Rule\Variant\IntegerRule;
use Gerfey\Mapper\Rule\Variant\IpRule;
use Gerfey\Mapper\Rule\Variant\LimitRule;
use Gerfey\Mapper\Rule\Variant\ObjectRule;
use Gerfey\Mapper\Rule\Variant\StringRule;

class RuleMapper
{
    public static function setRule(string $name)
    {
        switch ($name) {
            case 'limit':
                return new LimitRule();
                break;
            case 'array':
                return new ArrayRule();
                break;
            case 'boolean':
                return new BooleanRule();
                break;
            case 'double':
                return new DoubleRule();
                break;
            case 'email':
                return new EmailRule();
                break;
            case 'float':
                return new FloatRule();
                break;
            case 'int':
            case 'integer':
                return new IntegerRule();
                break;
            case 'ip':
                return new IpRule();
                break;
            case 'object':
                return new ObjectRule();
                break;
            case 'string':
                return new StringRule();
                break;
        }
    }
}