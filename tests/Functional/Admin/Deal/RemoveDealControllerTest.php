<?php

namespace App\Tests\Functional\Admin\Deal;

use App\Entity\Ecommerce\DealEntity;
use App\Tests\Functional\ApiTestCase;
use App\Tests\Functional\Trait\Deal\DealTrait;
use App\Tests\Functional\Trait\Project\ProjectTrait;
use App\Tests\Functional\Trait\User\UserTrait;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class RemoveDealControllerTest extends ApiTestCase
{
    use UserTrait;
    use ProjectTrait;
    use DealTrait;

    /**
     * @throws Exception
     */
    public function testWithoutAuth(){
        $client = static::createClient();
        $entityManager = $this->getEntityManager();

        $user = $this->createUser($entityManager);
        $project = $this->createProject($entityManager, $user);
        $deal = $this->createDeal($entityManager, $project);

        $client->request(
            'DELETE',
            '/api/admin/project/' . $project->getId() .'/deal/'. $deal->getId() . '/',
        );

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $client->getResponse()->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testRemove(){
        $client = static::createClient();
        $entityManager = $this->getEntityManager();

        $user = $this->createUser($entityManager);
        $project = $this->createProject($entityManager, $user);
        $deal = $this->createDeal($entityManager, $project);

        $dealId = $deal->getId();

        $dealRepository = $this->getEntityManager()->getRepository(DealEntity::class);
        $dealEntity = $dealRepository->find($dealId);

        $this->assertTrue($dealEntity instanceof DealEntity);

        $client->loginUser($user);

        $client->request(
            'DELETE',
            '/api/admin/project/' . $project->getId() .'/deal/'. $deal->getId() . '/',
        );

        $this->assertEquals(Response::HTTP_NO_CONTENT, $client->getResponse()->getStatusCode());

        $dealEntity = $dealRepository->find($dealId);

        $this->assertFalse($dealEntity instanceof DealEntity);
    }
}
