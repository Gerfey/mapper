<?php

namespace Gerfey\Mapper;

use Doctrine\Common\Annotations\AnnotationReader;
use Gerfey\Mapper\Annotation\Field;
use Gerfey\Mapper\Annotation\Rule;
use Gerfey\Mapper\Rule\RuleMapper;

abstract class Mapper implements MapperInterface
{
    protected $object;

    private $reader;

    /**
     * Mapper constructor.
     *
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    public function __construct()
    {
        $this->reader = new AnnotationReader();
    }

    /**
     * @param string $strClassName
     * @param $context
     * @return object
     * @throws \ReflectionException
     * @throws \Exception
     */
    protected function fillData(string $strClassName, $context)
    {
        $class = new \ReflectionClass($strClassName);
        $this->object = $class->newInstanceWithoutConstructor();

        foreach ($class->getProperties() as $property) {
            $field = $this->reader->getPropertyAnnotation($property, Field::class);

            $propertyName = $this->inspectPropertyName($class, $property);

            if (!isset($propertyName)) continue;

            $value = '';
            if (!empty($field)) {
                if ($field->name == null) {
                    $field->name = $propertyName;
                }
                if ($this->checkContext($context, $field->name)) {
                    $value = $this->inspectValue($context[$field->name], $field->type);
                }
            } else {
                if ($this->checkContext($context, $propertyName)) {
                    $value = $this->inspectValue($context[$propertyName], 'mixed');
                }
            }

            $rule = $this->reader->getPropertyAnnotation($property, Rule::class);
            if (!empty($rule)) {
                $resultRule = RuleMapper::setRule($rule->name)->validation($value, $rule->params);
                if (!$resultRule) continue;
            }

            if ($property->isPublic()) {
                $this->object->{$propertyName} = $value;
            } else {
                $method = $this->getMethodName($propertyName);
                if ($class->hasMethod($method)) {
                    $this->object->$method($value);
                }
            }
        }

        return $this->object;
    }

    /**
     * @param \ReflectionClass $class
     * @param \ReflectionProperty $property
     * @return string
     */
    private function inspectPropertyName(\ReflectionClass $class, \ReflectionProperty $property)
    {
        $propertyName = $property->getName();
        if ($property->isPublic() || (!$property->isPublic() && $class->hasMethod($this->getMethodName($propertyName)))) {
            return $propertyName;
        }
        return '';
    }

    /**
     * @param $data
     * @param $type
     * @return array|bool|float|int|object|string|null
     * @throws \Exception
     */
    private function inspectValue($data, $type)
    {
        switch ($type) {
            case 'int':
            case 'integer':
                $value = (int)$data;
                break;
            case 'float':
            case 'double':
            case 'real':
                $value = (float)$data;
                break;
            case 'bool':
            case 'boolean':
                $value = (bool)$data;
                break;
            case 'array':
                $value = (array)$data;
                break;
            case 'string':
                $value = (string)$data;
                break;
            case 'object':
                $value = (object)$data;
                break;
            case 'date':
            case 'datetime':
                $validPattern = '~^\d{4}-\d{2}-\d{2}((T|\s{1})\d{2}:\d{2}:\d{2}(\.\d{1,3}(Z|)|(\+|\-)\d{2}:\d{2}|)|)$~';
                if (preg_match($validPattern, $data)) {
                    $value = new \DateTime($data);
                } else {
                    $value = (string)$data;
                }
                break;
            default:
                $value = $data;
                break;
        }

        return $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    private function getCamelCaseName($name)
    {
        return str_replace(
            ' ', '', ucwords(str_replace(array('_', '-'), ' ', $name))
        );
    }

    /**
     * @param string $propertyName
     * @return string
     */
    private function getMethodName(string $propertyName)
    {
        return 'set' . $this->getCamelCaseName($propertyName);
    }

    /**
     * @param $context
     * @param string $key
     * @return bool
     */
    private function checkContext($context, string $key): bool
    {
        return !empty($context[$key]);
    }
}