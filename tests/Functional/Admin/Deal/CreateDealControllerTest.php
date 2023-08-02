<?php

namespace App\Tests\Functional\Admin\Deal;

use App\Entity\Ecommerce\ContactsEntity;
use App\Entity\Ecommerce\DealEntity;
use App\Entity\Ecommerce\FieldEntity;
use App\Entity\Ecommerce\OrderEntity;
use App\Tests\Functional\ApiTestCase;
use App\Tests\Functional\Trait\Project\ProjectTrait;
use App\Tests\Functional\Trait\User\UserTrait;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CreateDealControllerTest extends ApiTestCase
{
    use UserTrait;
    use ProjectTrait;

    /**
     * @throws Exception
     */
    public function testWithoutAuth()
    {
        $client = static::createClient();
        $entityManager = $this->getEntityManager();

        $user = $this->createUser($entityManager);
        $project = $this->createProject($entityManager, $user);

        $client->request(
            'POST',
            '/api/admin/project/' . $project->getId() .'/deal/',
        );

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $client->getResponse()->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testCreateEmptyDeal()
    {
        $client = static::createClient();
        $entityManager = $this->getEntityManager();

        $user = $this->createUser($entityManager);
        $project = $this->createProject($entityManager, $user);

        $client->loginUser($user);

        $client->request(
            'POST',
            '/api/admin/project/' . $project->getId() .'/deal/',
            [],
            [],
            [],
            json_encode([])
        );

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $deal = json_decode($client->getResponse()->getContent(), true);

        $this->assertTrue(isset($deal['id']));

        $dealEntity = $this->getEntityManager()->getRepository(DealEntity::class)->find($deal['id']);

        $this->assertEquals($dealEntity->getId(), $deal['id']);
    }

    /**
     * @dataProvider positiveVariantsWithAllData
     *
     * @throws Exception
     */
    public function testCreateDealWithAll(array $requestContent)
    {
        $client = static::createClient();
        $entityManager = $this->getEntityManager();

        $user = $this->createUser($entityManager);
        $project = $this->createProject($entityManager, $user);

        $client->loginUser($user);

        $client->request(
            'POST',
            '/api/admin/project/' . $project->getId() .'/deal/',
            [],
            [],
            [],
            json_encode($requestContent)
        );

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * @dataProvider positiveVariantsContact
     *
     * @throws Exception
     */
    public function testCreateDealWithContacts(array $requestContent)
    {
        $client = static::createClient();
        $entityManager = $this->getEntityManager();

        $user = $this->createUser($entityManager);
        $project = $this->createProject($entityManager, $user);

        $client->loginUser($user);

        $client->request(
            'POST',
            '/api/admin/project/' . $project->getId() .'/deal/',
            [],
            [],
            [],
            json_encode($requestContent)
        );

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $deal = json_decode($client->getResponse()->getContent(), true);

        $this->assertTrue(isset($deal['id']));

        $dealEntity = $entityManager->getRepository(DealEntity::class)->find($deal['id']);

        $this->assertEquals($dealEntity->getId(), $deal['id']);
        $this->assertTrue(isset($deal['contacts']['id']));

        $contact = $entityManager->getRepository(ContactsEntity::class)->find($deal['contacts']['id']);

        $this->assertEquals($contact->getId(), $deal['contacts']['id']);
    }

    /**
     * @dataProvider positiveVariantsField
     *
     * @throws Exception
     */
    public function testCreateDealWithFields(array $requestContent)
    {
        $client = static::createClient();
        $entityManager = $this->getEntityManager();

        $user = $this->createUser($entityManager);
        $project = $this->createProject($entityManager, $user);

        $client->loginUser($user);

        $client->request(
            'POST',
            '/api/admin/project/' . $project->getId() .'/deal/',
            [],
            [],
            [],
            json_encode($requestContent)
        );

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $deal = json_decode($client->getResponse()->getContent(), true);

        $this->assertTrue(isset($deal['id']));

        $dealEntity = $this->getEntityManager()->getRepository(DealEntity::class)->find($deal['id']);

        $this->assertEquals($dealEntity->getId(), $deal['id']);

        foreach ($deal['fields'] as $field) {
            $this->assertTrue(isset($field['id']));

            $fieldEntity = $this->getEntityManager()->getRepository(FieldEntity::class)->find($field['id']);

            $this->assertEquals($fieldEntity->getId(), $field['id']);
        }
    }

    /**
     * @dataProvider positiveVariantsOrder
     *
     * @throws Exception
     */
    public function testCreateDealWithOrder(array $requestContent)
    {
        $client = static::createClient();
        $entityManager = $this->getEntityManager();

        $user = $this->createUser($entityManager);
        $project = $this->createProject($entityManager, $user);

        $client->loginUser($user);

        $client->request(
            'POST',
            '/api/admin/project/' . $project->getId() .'/deal/',
            [],
            [],
            [],
            json_encode($requestContent)
        );

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $deal = json_decode($client->getResponse()->getContent(), true);

        $this->assertTrue(isset($deal['id']));

        $dealEntity = $this->getEntityManager()->getRepository(DealEntity::class)->find($deal['id']);

        $this->assertEquals($dealEntity->getId(), $deal['id']);

        $this->assertTrue(isset($deal['orders']['id']));

        $order = $this->getEntityManager()->getRepository(OrderEntity::class)->find($deal['orders']['id']);

        $this->assertEquals($order->getId(), $deal['orders']['id']);
    }

    private function positiveVariantsWithAllData(): iterable
    {
        yield [
            'requestContent' => [
                "contacts" => [
                    "firstName" => "asdGHbdtm",
                    "phone" => "GHbdtm",
                    "email" => "GHbdtm",
                    "lastName" => "sdsd"
                ],
                "fields" => [
                    [
                        "name" => "sadasd",
                        "value" => "yttyt"
                    ],
                ],
                "order" => [
                    "products" => [
                        [
                            'name' => 'product 1',
                            'price' => [
                                'value' => 10000,
                                'valueFraction' => '100',
                            ]
                        ],
                        [
                            'name' => 'product 2',
                            'price' => [
                                'value' => 20000,
                                'valueFraction' => '200',
                            ]
                        ],
                        [
                            'name' => 'product 3',
                            'price' => [
                                'value' => 30000,
                                'valueFraction' => '300',
                            ]
                        ],
                    ],
                    "shipping" => [
                        'name' => 'delivery 1',
                        'type' => 'pickup',
                        'price' => [
                            'value' => 10000,
                            'valueFraction' => '100',
                        ]
                    ],
                    "promotions" => [
                        [
                            'name' => 'promotion 1',
                            'type' => 'code',
                            'price' => [
                                'value' => 10000,
                                'valueFraction' => '100',
                            ]
                        ]
                    ],
                ],
            ],
        ];
    }

    private function positiveVariantsContact(): iterable
    {
        yield [
            'requestContent' => [
                "contacts" => [
                    "firstName" => "asdGHbdtm",
                    "phone" => "GHbdtm",
                    "email" => "GHbdtm",
                    "lastName" => "sdsd"
                ],
            ],
        ];
    }

    private function positiveVariantsField(): iterable
    {
        yield [
            'requestContent' => [
                "fields" => [
                    [
                        "name" => "sadasd",
                        "value" => "yttyt"
                    ],
                ],
            ],
        ];
    }

    private function positiveVariantsOrder(): iterable
    {
        yield [
            'requestContent' => [
                "order" => [
                    [
                        "products" => null,
                        "shipping" => null,
                        "promotions" => null,
                    ],
                ],
            ],
        ];
    }
}
