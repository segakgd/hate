<?php

namespace App\Tests\Functional\Admin\Deal;

use App\Entity\Ecommerce\DealEntity;
use App\Tests\Functional\ApiTestCase;
use App\Tests\Functional\Trait\Deal\DealTrait;
use App\Tests\Functional\Trait\Project\ProjectTrait;
use App\Tests\Functional\Trait\User\UserTrait;
use Symfony\Component\HttpFoundation\Response;

class GetAllDealControllerTest extends ApiTestCase
{
    use UserTrait;
    use ProjectTrait;
    use DealTrait;

    public function testWithoutAuth(){
        $client = static::createClient();
        $entityManager = $this->getEntityManager();

        $user = $this->createUser($entityManager);
        $project = $this->createProject($entityManager, $user);

        $client->request(
            'GET',
            '/api/admin/project/' . $project->getId() .'/deal/',
        );

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $client->getResponse()->getStatusCode());
    }

    public function testGetAllDeal(){
        $client = static::createClient();
        $entityManager = $this->getEntityManager();

        $user = $this->createUser($entityManager);
        $project = $this->createProject($entityManager, $user);
        $deal1 = $this->createDeal($entityManager, $project);
        $deal2 = $this->createDeal($entityManager, $project);

        $client->loginUser($user);

        $client->request(
            'GET',
            '/api/admin/project/' . $project->getId() .'/deal/',
        );

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $deals = json_decode($client->getResponse()->getContent(), true);

        $this->assertTrue(count($deals) === 2);

        $this->assertTrue($deals[0]['id'] === $deal1->getId());
        $this->assertTrue($deals[1]['id'] === $deal2->getId());
    }
}
