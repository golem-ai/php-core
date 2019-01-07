<?php

namespace GolemAi\Core\Factory\Entity;

use GolemAi\Core\Converter\SnakeToCamelConverter;
use GolemAi\Core\Factory\Exception\MissingClassNameException;

class SnakeToCamelCaseEntityFactory implements EntityFactoryInterface
{
    /**
     * @var SnakeToCamelConverter
     */
    private $converter;

    public function __construct(SnakeToCamelConverter $converter)
    {
        $this->converter = $converter;
    }

    /**
     * @param $class
     * @param array $args
     *
     * @return object
     *
     * @throws MissingClassNameException
     * @throws \ReflectionException
     */
    public function create(array $args = array())
    {
        if (!isset($args['class'])) {
            throw new MissingClassNameException();
        }
        $class = $args['class'];

        $objectArgs = array();
        foreach ($args as $key => $arg) {
            $name = $this->converter->convert($key);
            $objectArgs[$name] = $arg;
        }

        $classReflection = new \ReflectionClass($class);
        $constructor = $classReflection->getConstructor();

        if (!is_object($constructor)) {
            return new $class();
        }

        $constructorParameters = $constructor->getParameters();

        return $classReflection->newInstanceArgs(
            $this->getParameters($constructorParameters, $objectArgs)
        );
    }

    /**
     * @param \ReflectionParameter[] $constructorParameters
     * @param $givenArgs
     *
     * @return array
     */
    private function getParameters(array $constructorParameters, $givenArgs)
    {
        $instanceArgs = array();
        foreach ($constructorParameters as $index => $parameter) {
            $name = $parameter->getName();
            try {
                $arg = $parameter->getDefaultValue();
            } catch (\ReflectionException $exception) {}

            if (array_key_exists($name, $givenArgs)) {
                $arg = $givenArgs[$name];
            }

            $instanceArgs[$index] = $arg;
        }

        return $instanceArgs;
    }
}