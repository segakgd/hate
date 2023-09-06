<?php

namespace App\Tests\Integration\Card;

use App\Dto\CartDto;
use App\Dto\Ecommerce\_deprecated\ProductCategoryDto;
use App\Dto\Ecommerce\ProductDto;
use App\Dto\Ecommerce\ProductVariantDto;
use App\Entity\Ecommerce\ProductCategory;
use App\Service\Card\CardServiceInterface;
use App\Service\Ecommerce\ProductCategoryService;
use App\Service\Ecommerce\ProductService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CardServiceTest extends KernelTestCase
{
//    protected function setUp(): void
//    {
//
//    }
//
//    protected function tearDown(): void
//    {
//
//    }

    /**
     * @throws Exception
     */
    public function testCard(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $cartDto = (new CartDto)
            ->setProducts(
                [
                    $this->generateTestProduct(20000, 2, 0),
                    $this->generateTestProduct(100000, 1, 10),
                ]
            )
            ->setTotalAmount(0)
        ;

        /** @var CardServiceInterface $cardServiceInterface */
        $cardServiceInterface = $container->get(CardServiceInterface::class);
        $recalculateDto = $cardServiceInterface->recalculate($cartDto);

        dd($recalculateDto);
    }

    /**
     * @throws Exception
     */
    private function generateTestProduct(int $price, int $count, int $percentDiscount): ProductDto
    {
        $container = static::getContainer();
        $productCategory = (new ProductCategoryDto())
            ->setName('Категория')
        ;

        /** @var ProductCategoryService $productCategoryService */
        $productCategoryService = $container->get(ProductCategoryService::class);
        $productCategoryEntity = $productCategoryService->add($productCategory, 1);

        $productCategory->setId($productCategoryEntity->getId());

        $variant = (new ProductVariantDto())
            ->setPrice(
                [
                    'value' => $price,
                    'valueFraction' => $price / 100,
                ]
            )
            ->setCount($count)
            ->setPercentDiscount($percentDiscount)
        ;

        $productDto = (new ProductDto())
            ->addVariant($variant)
            ->addCategory($productCategory)
        ;

        /** @var ProductService $productService */
        $productService = $container->get(ProductService::class);
        $productEntity = $productService->add($productDto, 1);

        dd($productEntity);

        return $productDto;
    }
}
