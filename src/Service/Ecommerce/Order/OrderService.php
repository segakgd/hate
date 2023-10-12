<?php

namespace App\Service\Ecommerce\Order;

use App\Dto\Ecommerce\OrderDto;
use App\Entity\Lead\DealOrder;
use App\Repository\Lead\OrderEntityRepository;

class OrderService
{
    public function __construct(
        private OrderEntityRepository $orderEntityRepository,
    ){
    }

    public function add(OrderDto $dto): DealOrder
    {
        $entity = (new DealOrder());

        $entity = self::mapToExistEntity($dto, $entity);

//        dd($entity);

        $this->orderEntityRepository->saveAndFlush($entity);
        dd($entity);


        return $entity;
    }

    public function update(OrderDto $dto): ?DealOrder
    {
        $entity = $this->orderEntityRepository->find($dto->getId());

        if (!$entity){
            $entity = (new DealOrder());
        }

        $entity = self::mapToExistEntity($dto, $entity);

        $this->orderEntityRepository->saveAndFlush($entity);

        return $entity;
    }

    public static function mapToExistEntity(OrderDto $dto, DealOrder $entity): DealOrder
    {
        // todo мы можем добавить сущесвтующие продукты.
        if ($products = $dto->getProducts()){
            foreach ($products as $product){
                $entity->addProduct($product);
            }
        }

//        // todo мы можем добавить сущесвтующие скидки.
//        if ($promotions = $dto->getPromotions()){
//            foreach ($promotions as $promotion){
//                $entity->addPromotion($promotion);
//            }
//        }
//
//        // todo мы можем добавить сущесвтующие доставки.
//        if ($shipping = $dto->getShipping()){
//            $entity->setShipping($shipping->toArray());
//        }
//
//        // вообще, можно прям тут пересчитывать
//        if ($totalAmount = $dto->getTotalAmount()){
//            $entity->setTotalAmount($totalAmount);
//        }

        return $entity;
    }
}