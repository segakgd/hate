<?php

namespace App\Service\Mapper\Main;

use App\Dto\Ecommerce\ProductDto;
use App\Dto\Project\ProjectDto;
use App\Dto\Security\UserDto;
use App\Entity\User\Project;
use App\Entity\User\User;
use ReflectionException;
use ReflectionObject;

class MainMapperService implements MainMapperServiceInterface
{
    const CONFIG = [
        Project::class => ProjectDto::class,
        User::class => UserDto::class,
    ];

    /**
     * @throws ReflectionException
     */
    public function mapToDto(object|array $object): object
    {
        $dto = self::CONFIG[get_class($object)];

        $dto = new $dto;

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
//        dd($dto, $object);

        $properties = $reflectionObjectEntity->getProperties();

        foreach ($properties as $property){

            if (property_exists($dto, $property->getName())){
                $propertyDto = $reflectionObjectDto->getProperty($property->getName());

                $value = $property->getValue($object);

                if ($this->isCollection($value)){
//                    $dto = $this->mapCollection($propertyDto, $dto, $value);
                } else {
                    $dto = $this->mapScalar($propertyDto, $dto, $value);
                }
            }
        }

//        dd(
//            $dto->getName()
//        );

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

        return $dto;
    }

    public function isCollection(mixed $value): bool
    {
        return $value instanceof \ArrayAccess;
    }


    private function mapScalar($propertyDto, $dto, $value): object
    {
        $propertyDto->setValue($dto, $value);

        return $dto;
    }

    private function mapCollection($propertyDto, $dto, \ArrayAccess $values): object
    {
        foreach ($values as $value){
            dd($value);
        }


//        $propertyDto->setValue($dto, $value);

        return $dto;
    }

}