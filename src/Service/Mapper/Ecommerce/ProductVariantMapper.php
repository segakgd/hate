<?php

namespace App\Service\Mapper\Ecommerce;

use App\Dto\Ecommerce\ProductVariantDto;
use App\Entity\Ecommerce\ProductVariant;

class ProductVariantMapper
{
    public static function mapToEntity(ProductVariantDto $dto): ProductVariant
    {
        return self::mapToExistEntity($dto, (new ProductVariant()));
    }

    public static function mapToExistEntity(ProductVariantDto $dto, ProductVariant $entity): ProductVariant
    {
        if ($name = $dto->getName()){
            $entity->setName($name);
        }

        if ($article = $dto->getArticle()){
            $entity->setArticle($article);
        }

        if ($image = $dto->getImage()){
            $entity->setImage($image);
        }

        if ($price = $dto->getPrice()){
            $entity->setPrice($price);
        }

        if ($count = $dto->getCount()){
            $entity->setCount($count);
        }

        if ($promotionDistributed = $dto->isPromotionDistributed()){
            $entity->setPromotionDistributed($promotionDistributed);
        }

        if ($percentDiscount = $dto->getPercentDiscount()){
            $entity->setPercentDiscount($percentDiscount);
        }

        if ($active = $dto->isActive()){
            $entity->setActive($active);
        }

        if ($activeFrom = $dto->getActiveFrom()){
            $entity->setActiveFrom($activeFrom);
        }

        if ($activeTo = $dto->getActiveTo()){
            $entity->setActiveTo($activeTo);
        }

        return $entity;
    }
}
