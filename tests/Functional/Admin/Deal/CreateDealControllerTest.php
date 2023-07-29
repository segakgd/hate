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
    public function testWithoutAuth(){
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
    public function testCreateDeal(){
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

        $dealRepository = $this->getEntityManager()->getRepository(DealEntity::class);
        $dealEntity = $dealRepository->find($deal['id']);

        $this->assertEquals($dealEntity->getId(), $deal['id']);
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

        $dealRepository = $this->getEntityManager()->getRepository(DealEntity::class);
        $dealEntity = $dealRepository->find($deal['id']);

        $this->assertEquals($dealEntity->getId(), $deal['id']);

        $this->assertTrue(isset($deal['contacts']['id']));

        $contactsRepository = $this->getEntityManager()->getRepository(ContactsEntity::class);
        $contact = $contactsRepository->find($deal['contacts']['id']);

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

        $dealRepository = $this->getEntityManager()->getRepository(DealEntity::class);
        $dealEntity = $dealRepository->find($deal['id']);

        $this->assertEquals($dealEntity->getId(), $deal['id']);

        foreach ($deal['fields'] as $field) {
            $this->assertTrue(isset($field['id']));

            $fieldRepository = $this->getEntityManager()->getRepository(FieldEntity::class);
            $fieldEntity = $fieldRepository->find($field['id']);

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

        $dealRepository = $this->getEntityManager()->getRepository(DealEntity::class);
        $dealEntity = $dealRepository->find($deal['id']);

        $this->assertEquals($dealEntity->getId(), $deal['id']);

        $this->assertTrue(isset($deal['orders']['id']));

        $orderRepository = $this->getEntityManager()->getRepository(OrderEntity::class);
        $order = $orderRepository->find($deal['orders']['id']);

        $this->assertEquals($order->getId(), $deal['orders']['id']);
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
