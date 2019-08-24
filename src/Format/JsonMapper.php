<?php

namespace Gerfey\Mapper\Format;

use Gerfey\Mapper\Mapper;

class JsonMapper extends Mapper
{
    /**
     * @param object $object
     * @param object $context
     * @return object
     */
    public function map($object, $context)
    {
        if (!is_object($context)) {
            throw new \InvalidArgumentException(
                'Requires second argument to be an object'
                . ', ' . gettype($context) . ' given.'
            );
        }

        foreach ($context as $key => $value) {
            $this->fillData($object, $key, $value);
        }
        return $object;
    }
}