<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Lead\Deal;

class DealMapper
{
    public static function mapToDto(Deal $entity): DealDto
    {
        return self::mapToExistDto($entity, (new DealDto));
    }

    public static function mapToEntity(DealDto $dto): Deal
    {
         return self::mapToExistEntity($dto, (new Deal()));
    }

    public static function mapToExistDto(Deal $entity, DealDto $dto): DealDto
    {
        if ($fields = $entity->getFields()){
            foreach ($fields as $field){
                $dto->addField(FieldMapper::mapToDto($field));
            }
        }

        return $dto
            ->setContacts(ContactsMapper::mapToDto($entity->getContacts())) // todo надо мапть в существующие dto
            ->setOrder(OrderMapper::mapToDto($entity->getOrders())) // todo надо мапть в существующие dto
        ;
    }

    public static function mapToExistEntity(DealDto $dto, Deal $entity): Deal
    {
        if ($contacts = $dto->getContacts()){
            if ($entity->getContacts()){
                $entity->setContacts(ContactsMapper::mapToExistEntity($contacts, $entity->getContacts()));
            } else {
                $entity->setContacts(ContactsMapper::mapToEntity($contacts));
            }
        }

        if ($fieldsDto = $dto->getFields()){
            if ($entity->getFields()->count()){
                $fieldsEntity = $entity->getFields();

                foreach ($fieldsDto as $fieldDto){
                    $isUpdated = false;

                    foreach ($fieldsEntity as $fieldEntity){
                        if ($fieldDto->getId() === $fieldEntity->getId()){
                            $entity->addField(FieldMapper::mapToExistEntity($fieldDto, $fieldEntity));

                            $isUpdated = true;
                        }
                    }

                    if (!$isUpdated){
                        $entity->addField(FieldMapper::mapToEntity($fieldDto));
                    }
                }

            } else {
                foreach ($fieldsDto as $fieldDto){
                    $entity->addField(FieldMapper::mapToEntity($fieldDto));
                }
            }
        }

        if ($order = $dto->getOrder()){
            if ($entity->getOrders()){
                $entity->setOrders(OrderMapper::mapToExistEntity($order, $entity->getOrders()));
            } else {
                $entity->setOrders(OrderMapper::mapToEntity($order));
            }
        }

        return $entity;
    }
}
