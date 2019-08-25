<?php

namespace Gerfey\Mapper;

interface MapperInterface
{
    /**
     * @param string $strClassName
     * @param mixed $context
     * @return object
     */
    public function map(string $strClassName, $context);
}