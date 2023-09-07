<?php

namespace App\Mapper\Main;

use App\Dto\Ecommerce\ProductDto;
use App\Entity\User\Project;
use Doctrine\Common\Collections\ArrayCollection;
use ReflectionObject;

class MainMapper
{
    const CONFIG = [
        Project::class => ProductDto::class
    ];

    public function map(object|array $object): void
    {
        $dto = self::CONFIG[get_class($object)];

        $dto = new $dto();


//        if (is_array($object)){
//            foreach ($object as $key => $objectItem){
//                if (is_object($objectItem)){
//                    $this->map($objectItem, $properties[$key]);
//                }
//            }
//
//            return;
//        }

        // Используем рефлексию php чтоб прочитать даже private данные
        $reflectionObjectEntity = new ReflectionObject($object);
        $reflectionObjectDto = new ReflectionObject($dto);

        $properties = $reflectionObjectEntity->getProperties();

        foreach ($properties as $property){
            $propertyDto = $reflectionObjectDto->getProperty($property->getName());
            $propertyDto->setValue($property->getValue());
        }

//        foreach ($properties as $propertyName => $propertyValue){
//            if (is_array($propertyValue)){
//                $arrayCollection = $reflectionObject->getProperties($propertyName)->getValue($object);
//
//                if ($arrayCollection instanceof ArrayCollection){
//                    $arrayCollection = $arrayCollection->toArray();
//                }
//                continue;
//            }
//
//            // проверяем, есть ли заданное в параметрах свойство
//            if (!$reflectionObject->hasProperty($propertyName)){
//                $message = "Неизвестное поле $propertyName \n\n" . "Доступные поля: \n";
//
//                foreach ($reflectionObject->getProperties() as $property){
//                    $message .= $property->getName() . "\n";
//                }
//            }
//        }

    }
}