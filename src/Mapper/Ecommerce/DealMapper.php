<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Ecommerce\DealEntity;

class DealMapper
{
    public static function mapToDto(DealEntity $dealEntity): DealDto
    {
        $dealDto = (new DealDto)
            ->setContacts($dealEntity->getContacts())
            ->setOrder($dealEntity->getOrders())
        ;

        if ($fields = $dealEntity->getFields()){
            foreach ($fields as $field){
                $dealDto->addField(FieldMapper::mapToDto($field));
            }
        }

        return $dealDto;
    }

    public static function mapToEntity(DealDto $dealDto): DealEntity
    {
        $dealEntity = (new DealEntity);

        if ($contacts = $dealDto->getContacts()){
            $dealEntity->setContacts(ContactsMapper::mapToEntity($contacts));
        }

        if ($fields = $dealDto->getFields()){
            foreach ($fields as $field){
                $dealEntity->addField(FieldMapper::mapToEntity($field));
            }
        }

        if ($order = $dealDto->getOrder()){
            $dealEntity->setOrders(OrderMapper::mapToEntity($order));
        }

        return $dealEntity;
    }

    public static function mapToExistDto(DealEntity $dealEntity, DealDto $dealDto): DealDto
    {
        if ($fields = $dealEntity->getFields()){
            foreach ($fields as $field){
                $dealDto->addField(FieldMapper::mapToDto($field));
            }
        }

        return $dealDto
            ->setContacts($dealEntity->getContacts())
            ->setOrder($dealEntity->getOrders())
        ;
    }

    public static function mapToExistEntity(DealDto $dealDto, DealEntity $dealEntity): DealEntity
    {
        if ($contacts = $dealDto->getContacts()){
            if ($dealEntity->getContacts()){
                $dealEntity->setContacts(ContactsMapper::mapToExistEntity($contacts, $dealEntity->getContacts()));
            } else {
                $dealEntity->setContacts(ContactsMapper::mapToEntity($contacts));
            }
        }

        if ($fieldsDto = $dealDto->getFields()){
            if ($fieldsEntity = $dealEntity->getFields()){

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
