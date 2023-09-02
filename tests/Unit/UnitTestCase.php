<?php

namespace App\Tests\Unit;

use Doctrine\Common\Collections\ArrayCollection;
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
    public function assertObjectProperties(object|array $object, array $properties): void // todo декомпозировать
    {
        if (is_array($object)){
            foreach ($object as $key => $objectItem){
                if (is_object($objectItem)){
                    $this->assertObjectProperties($objectItem, $properties[$key]);
                }
            }

            return;
        }

        // Используем рефлексию php чтоб прочитать даже private данные
        $reflectionObject = new ReflectionObject($object);

        foreach ($properties as $propertyName => $propertyValue){
            if (is_array($propertyValue)){
                $arrayCollection = $reflectionObject->getProperty($propertyName)->getValue($object);

                if ($arrayCollection instanceof ArrayCollection){
                    $arrayCollection = $arrayCollection->toArray();
                }

                $this->assertObjectProperties($arrayCollection, $propertyValue);

                continue;
            }

            // проверяем, есть ли заданное в параметрах свойство
            if (!$reflectionObject->hasProperty($propertyName)){
                $message = "Неизвестное поле $propertyName \n\n" . "Доступные поля: \n";

                foreach ($reflectionObject->getProperties() as $property){
                    $message .= $property->getName() . "\n";
                }

                $this->fail($message);
            }

            // проверяем значение
            self::assertEquals($reflectionObject->getProperty($propertyName)->getValue($object), $propertyValue);
        }
    }
}
