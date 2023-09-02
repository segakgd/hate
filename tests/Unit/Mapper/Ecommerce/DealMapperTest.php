<?php

namespace App\Tests\Unit\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\PromotionDto;
use App\Dto\Ecommerce\ProductDto;
use App\Entity\Lead\Contacts;
use App\Entity\Lead\Deal;
use App\Entity\Lead\Field;
use App\Entity\Lead\Order;
use App\Mapper\Ecommerce\DealMapper;
use App\Tests\Unit\UnitTestCase;
use DateTimeImmutable;
use ReflectionException;

class DealMapperTest extends UnitTestCase
{
    /**
     * @throws ReflectionException
     */
    public function testMapToDto(): void
    {
        $dateTime = new DateTimeImmutable();

        $contacts = (new Contacts())
            ->setFirstName('Дима')
            ->setLastName('Миколаев')
            ->setEmail('nanana@mypost.com')
            ->setPhone('89990999099')
            ->setCreatedAt($dateTime)
        ;

        $productDto = (new ProductDto())
            ->setProjectId(1)
            ->setUpdatedAt($dateTime)
            ->setCreatedAt($dateTime)
        ;

        $promotionDto = (new PromotionDto())
            ->setName('Скидка 10 %')
        ;

        $shippingDto = [
            'id' => 1,
            'title' => 'Доставка до дома',
            'type' => 'courier',
            'price' => '100',
        ];

        $order = (new Order())
            ->addProduct($productDto)
            ->addPromotion($promotionDto)
            ->setShipping($shippingDto)
            ->setTotalAmount(10000)
            ->setCreatedAt($dateTime)
            ->setUpdatedAt($dateTime)
        ;

        $field = (new Field())
            ->setName('Поле Имя')
            ->setValue('Эрик')
            ->setCreatedAt(new DateTimeImmutable())
        ;

        $entity = (new Deal())
            ->setContacts($contacts)
            ->addField($field)
            ->setOrders($order)
            ->setProjectId(1)
        ;

        $dto = DealMapper::mapToDto($entity);

        $this->assertObjectProperties(
            $dto,
            [
                'contacts' => [
                    'firstName' => 'Дима',
                    'lastName' => 'Миколаев',
                    'email' => 'nanana@mypost.com',
                    'phone' => '89990999099',
                ],
                'fields' => [
                    [
                        'name' => 'Поле Имя',
                        'value' => 'Эрик',
                    ]
                ],
                'order' => [
                    'products' => [
                        [
                            'projectId' => 1
                        ]
                    ],
                    'promotions' => [
                        [
                            'name' => 'Скидка 10 %'
                        ]
                    ],
                    'shipping' => [
                        'title' => 'Доставка до дома',
                        'type' => 'courier',
                        'price' => [
                            'value' => '0', // todo почему 0?
                        ],
                    ],
                    'totalAmount' => 10000,
                ],
            ]
        );
    }
}