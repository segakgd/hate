<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use ReflectionObject;

class UnitTestCase extends TestCase
{
    /**
     * Проверяет соответствие данных свойств объекта с параметрами массива
     *
     * @throws ReflectionException
     */
    public function assertObjectVars(object $object, array $properties): void
    {
        // Используем рефлексию php чтоб прочитать даже private данные
        $reflectionObject = new ReflectionObject($object);

        foreach ($properties as $propertyName => $propertyValue){
            // проверяем, есть ли заданное в параметрах свойство
            $reflectionObject->hasProperty($propertyName);

            // проверяем значение
            self::assertEquals($reflectionObject->getProperty($propertyName)->getValue($object), $propertyValue);
        }
    }
}