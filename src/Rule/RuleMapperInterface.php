<?php

namespace Gerfey\Mapper\Rule;

interface RuleMapperInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param $value
     * @param mixed $params
     * @return mixed
     */
    public function validation($value, $params = []): bool;
}