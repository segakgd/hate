<?php

namespace App\Service\Mapper;

use App\Dto\CartDto;
use App\Entity\Visitor\Cart;

class CartMapper
{
    public static function mapToDto(Cart $cartEntity): CartDto
    {
        return self::mapToExistDto($cartEntity, (new CartDto));

    }

    public static function mapToEntity(CartDto $cartDto): Cart
    {
        return self::mapToExistEntity($cartDto, (new Cart()));
    }

    public static function mapToExistDto(Cart $cartEntity, CartDto $cartDto): CartDto
    {
        return $cartDto
            ->setId($cartEntity->getId())
            ->setProducts($cartEntity->getProducts())
            ->setTotalAmount($cartEntity->getTotalAmount())
            ->setVisitorId($cartEntity->getVisitorId())
            ->setCreatedAt($cartEntity->getCreatedAt())
            ;
    }

    public static function mapToExistEntity(CartDto $cartDto, Cart $cartEntity): Cart
    {
        if ($products = $cartDto->getProducts()){
            $cartEntity->setProducts($products);
        }

        if ($totalAmount = $cartDto->getTotalAmount()){
            $cartEntity->setTotalAmount($totalAmount);
        }

        if ($visitorId = $cartDto->getVisitorId()){
            $cartEntity->setVisitorId($visitorId);
        }

        if ($createdAt = $cartDto->getCreatedAt()){
            $cartEntity->setCreatedAt($createdAt);
        }

        if ($status = $cartDto->getStatus()){
            $cartEntity->setStatus($status);
        }

        return $cartEntity;
    }
}
