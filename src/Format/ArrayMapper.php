<?php

namespace Gerfey\Mapper\Format;

use Gerfey\Mapper\Mapper;

class ArrayMapper extends Mapper
{
    /**
     * @param string $strClassName
     * @param array $context
     * @return object
     * @throws \ReflectionException
     */
    public function map(string $strClassName, $context)
    {
        if (!is_array($context)) {
            throw new \InvalidArgumentException(
                'ArrayMapper::map() requires second argument to be an object'
                . ', ' . gettype($context) . ' given.'
            );
        }

        return $this->fillData($strClassName, $context);
    }
}