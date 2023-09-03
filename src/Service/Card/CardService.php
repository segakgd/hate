<?php

namespace App\Service\Card;

use App\Dto\CartDto;
use App\Dto\Ecommerce\ProductDto;
use App\Service\Ecommerce\ProductServiceInterface;
use App\Service\Ecommerce\PromotionServiceInterface;
use App\Service\Ecommerce\ShippingServiceInterface;

class CardService implements CardServiceInterface
{
    public function __construct(
        private ProductServiceInterface $productService,
        // private PromotionServiceInterface $promotionService, todo нужно будет учитывать
        // private ShippingServiceInterface $service, todo нужно будет учитывать
    ) {
    }

    public function recalculate(CartDto $cartDto): CartDto
    {
        $cartDto = $this->recalculateProduct($cartDto);

        return $cartDto;
    }

    private function recalculateProduct(CartDto $cartDto): CartDto
    {
        $allPrice = 0;

        /** @var ProductDto $product */
        foreach ($cartDto->getProducts() as $product){
            foreach ($product->getVariants() as $variant){

                if (!$this->productService->isExist($variant->getId())){ // todo проверить на наличие, на принадлежность к проекту, на резерв
                    continue; // todo вернуть ошибку
                }

                // получаем цену
                $price = $variant->getPrice();
                $realPrice = $price;

                // узнаём, есть ли скидка
                $percentDiscount = $variant->getPercentDiscount();

                if ($percentDiscount){
                    $realPrice = $price - (($price * 0.01) * $percentDiscount);
                }

                $allPrice += $realPrice;

                // узнаём, применяется ли общая скидка
                $variant->isPromotionDistributed(); // todo надо обработать
            }
        }

        $cartDto->setTotalAmount($allPrice);

        return $cartDto;
    }
}
