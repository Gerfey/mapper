<?php

namespace Gerfey\Mapper\Annotation;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class Field
{
    /**
     * @var string
     */
    public $name = null;

    /**
     * @var string
     */
    public $type = 'string';

    /**
     * @var string
     */
    public $passIn = null;

    public function __construct($values)
    {
        if (!empty($values['name'])) {
            $this->name = $values['name'];
        }
        if (!empty($values['type'])) {
            $this->type = $values['type'];
        }
        if (!empty($values['type']) && $values['type'] == 'object') {
            if (!empty($values['passIn'])) {
                $this->passIn = $values['passIn'];
            }
        }
    }
}