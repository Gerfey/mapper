<?php

namespace Gerfey\Mapper;

use ReflectionClass;

abstract class Mapper implements MapperInterface
{
    protected $fillable = [];

    /**
     * @param $object
     * @param string $key
     * @param string $value
     * @throws \ReflectionException
     */
    protected function fillData($object, string $key, string $value): void
    {
        $rClass = new ReflectionClass(get_class($object));

        $property = $this->inspectProperty($rClass, $this->getFillable($rClass, $object, $key));
        if ($property) {
            $rClass->getProperty($property)->setValue($object, $value);
        } else {
            $parameters = $this->inspectParameters($rClass, $this->getFillable($rClass, $object, $key));
            if ($parameters) {
                $parameters->invoke($object, $value);
            }
        }
    }

    /**
     * @param ReflectionClass $class
     * @param $name
     * @return bool
     */
    private function inspectProperty(ReflectionClass $class, $name)
    {
        if ($class->hasProperty($name)) {
            $rProperty = $class->getProperty($name);
            if ($rProperty->isPublic()) {
                return $rProperty->name;
            }
        }
        return false;
    }

    /**
     * @param ReflectionClass $class
     * @param $name
     * @return bool|\ReflectionMethod
     * @throws \ReflectionException
     */
    private function inspectParameters(ReflectionClass $class, $name)
    {
        $setter = 'set' . $this->getCamelCaseName($name);
        if ($class->hasMethod($setter)) {
            $rMethod = $class->getMethod($setter);
            if ($rMethod->isPublic()) {
                return $rMethod;
            }
        }
        return false;
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
     * @param ReflectionClass $rClass
     * @param $object
     * @param $key
     * @return mixed
     */
    private function getFillable(ReflectionClass $rClass, $object, $key)
    {
        if ($rClass->hasProperty('fillable')) {
            $rProperty = $rClass->getProperty('fillable');
            if ($rProperty->isPublic()) {
                $fillable = $rProperty->getValue($object);
                if (count($fillable) > 0 && !empty($fillable[$key])) {
                    return $fillable[$key];
                }
            }
        }
        return $key;
    }
}