<?php

namespace App\Tests\Unit\Mapper\Project;

use App\Dto\Project\ProjectDto;
use App\Entity\User\Project;
use App\Entity\User\User;
use App\Service\Mapper\Project\ProjectMapper;
use App\Tests\Unit\UnitTestCase;
use ReflectionException;

class ProjectMapperTest extends UnitTestCase
{
    /**
     * @throws ReflectionException
     */
    public function testMapToDto(): void
    {
        $user = (new User())
            ->setEmail('email')
            ->setPassword('pass')
        ;

        $entity = (new Project())
            ->setName('Проект 1')
            ->addUser($user)
        ;

        $dto = ProjectMapper::mapToDto($entity);

        $this->assertObjectProperties(
            $dto,
            [
                'name' => 'Проект 1'
            ]
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMapToEntity(): void
    {
        $dto = (new ProjectDto())
            ->setName('Проект 1')
        ;

        $entity = ProjectMapper::mapToEntity($dto);

        $this->assertObjectProperties(
            $entity,
            [
                'name' => 'Проект 1'
            ]
        );
    }
}
