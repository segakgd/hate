<?php

namespace App\Tests\Functional\Admin\Deal;

use App\Tests\Functional\ApiTestCase;
use App\Tests\Functional\Trait\Project\ProjectTrait;
use App\Tests\Functional\Trait\User\UserTrait;

class CreateDealControllerTest extends ApiTestCase
{
    use UserTrait;
    use ProjectTrait;

    public function testCreateDeal(){
        $client = static::createClient();

        $entityManager = $this->getEntityManager();

        $user = $this->createUser($entityManager); // todo должен быть уникальным
        $project = $this->createProject($entityManager, $user);

        $client->loginUser($user);

        $client->request(
            'POST',
            '/api/admin/project/' . $project->getId() .'/deal/',
            [],
            [],
            [],
            '{
                "contacts": {
                    "firstName": "asdGHbdtm",
                    "phone": "GHbdtm",
                    "email": "GHbdtm",
                    "lastName": "sdsd"
                },
                "fields": [
                    {
                        "name": "sadasd",
                        "value": "yttyt"
                    }
                ]
            }'
        );

        dd($client->getResponse());
    }
}