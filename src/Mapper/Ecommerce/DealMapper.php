<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Lead\Deal;

class DealMapper
{
    public static function mapToDto(Deal $dealEntity): DealDto
    {
        return self::mapToExistDto($dealEntity, (new DealDto));
    }

    public static function mapToEntity(DealDto $dealDto): Deal
    {
         return self::mapToExistEntity($dealDto, (new Deal()));
    }

    public static function mapToExistDto(Deal $dealEntity, DealDto $dealDto): DealDto
    {
        if ($fields = $dealEntity->getFields()){
            foreach ($fields as $field){
                $dealDto->addField(FieldMapper::mapToDto($field));
            }
        }

        return $dealDto
            ->setContacts(ContactsMapper::mapToDto($dealEntity->getContacts())) // todo надо мапть в существующие dto
            ->setOrder(OrderMapper::mapToDto($dealEntity->getOrders())) // todo надо мапть в существующие dto
        ;
    }

    public static function mapToExistEntity(DealDto $dealDto, Deal $dealEntity): Deal
    {
        if ($contacts = $dealDto->getContacts()){
            if ($dealEntity->getContacts()){
                $dealEntity->setContacts(ContactsMapper::mapToExistEntity($contacts, $dealEntity->getContacts()));
            } else {
                $dealEntity->setContacts(ContactsMapper::mapToEntity($contacts));
            }
        }

        if ($fieldsDto = $dealDto->getFields()){
            if ($dealEntity->getFields()->count()){
                $fieldsEntity = $dealEntity->getFields();

                foreach ($fieldsDto as $fieldDto){
                    $isUpdated = false;

                    foreach ($fieldsEntity as $fieldEntity){
                        if ($fieldDto->getId() === $fieldEntity->getId()){
                            $dealEntity->addField(FieldMapper::mapToExistEntity($fieldDto, $fieldEntity));

                            $isUpdated = true;
                        }
                    }

                    if (!$isUpdated){
                        $dealEntity->addField(FieldMapper::mapToEntity($fieldDto));
                    }
                }

            } else {
                foreach ($fieldsDto as $fieldDto){
                    $dealEntity->addField(FieldMapper::mapToEntity($fieldDto));
                }
            }
        }

        if ($order = $dealDto->getOrder()){
            if ($dealEntity->getOrders()){
                $dealEntity->setOrders(OrderMapper::mapToExistEntity($order, $dealEntity->getOrders()));
            } else {
                $dealEntity->setOrders(OrderMapper::mapToEntity($order));
            }
        }

        return $dealEntity;
    }
}
