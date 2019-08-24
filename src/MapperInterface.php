<?php

namespace Gerfey\Mapper;

interface MapperInterface
{
    /**
     * @param object $strClassName
     * @param mixed $context
     * @return object
     */
    public function map($object, $context);
}