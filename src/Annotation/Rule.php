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
        if (!empty($values['params']) && is_array($values['params'])) {
            $this->params = $values['params'];
        } elseif (!empty($values['params']) && isset($values['params'])) {
            $this->params = explode(',', $values['params']);
        }
    }
}