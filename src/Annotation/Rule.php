<?php

namespace Gerfey\Mapper\Annotation;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class Rule
{
    /**
     * @var string
     */
    public $name = null;

    /**
     * @var array
     */
    public $params = null;

    public function __construct($values)
    {
        $this->name = $values['name'];
        if (isset($values['params'])) {
            $this->params = explode(',', $values['params']);
        }
    }
}