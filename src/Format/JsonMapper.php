<?php

namespace Gerfey\Mapper\Format;

use Gerfey\Mapper\Mapper;

class JsonMapper extends Mapper
{
    /**
     * @param string $strClassName
     * @param object $context
     * @return object
     * @throws \ReflectionException
     */
    public function map(string $strClassName, $context)
    {
        if (!is_object($context)) {
            throw new \InvalidArgumentException(
                'ArrayMapper::map() requires second argument to be an object'
                . ', ' . gettype($context) . ' given.'
            );
        }

        return $this->fillData($strClassName, $this->convertJsonToArray($context));
    }

    /**
     * @param $context
     * @return mixed
     */
    private function convertJsonToArray($context)
    {
        return json_decode(json_encode($context), true);
    }
}