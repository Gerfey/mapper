<?php

namespace Gerfey\Mapper\Converter;

use Gerfey\Mapper\Rule\RuleMapper;

class DataConverter
{
    public static function convert($value, string $type, $rule)
    {
        $checkRule = (new DataConverter)->checkRule($value, $rule);
        if ($checkRule) {
            return (new DataConverter)->inspectValue($value, $type);
        } else {
            return null;
        }
    }

    /**
     * @param $value
     * @param string $type
     * @return array|bool|float|int|object|string
     * @throws \Exception
     */
    private function inspectValue($value, string $type)
    {
        if (in_array($type, ['int', 'integer'])) {
            $value = (int)$value;
        } elseif (in_array($type, ['float', 'double', 'real'])) {
            $value = (float)$value;
        } elseif (in_array($type, ['bool', 'boolean'])) {
            $value = (bool)$value;
        } elseif (in_array($type, ['array'])) {
            $value = (array)$value;
        } elseif (in_array($type, ['string'])) {
            $value = (string)$value;
        } elseif (in_array($type, ['object'])) {
            $value = (object)$value;
        } elseif (in_array($type, ['date'])) {
            $value = new \DateTime(date('Y-m-d', strtotime($value)));
        } elseif (in_array($type, ['datetime'])) {
            $value = new \DateTime(date('Y-m-d H:i:s', strtotime($value)));
        }
        return $value;
    }

    /**
     * @param $value
     * @param $rule
     * @return bool
     */
    private function checkRule($value, $rule)
    {
        if (!empty($rule)) {
            $ruleMapper = RuleMapper::setRule($rule->name);
            if (!empty($ruleMapper)) {
                $resultRule = $ruleMapper->validation($value, $rule->params);
                if (!$resultRule) {
                    return false;
                }
                return true;
            }
            return false;
        }
        return true;
    }
}