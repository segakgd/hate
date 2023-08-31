<?php

namespace App\Tests\Unit\Mapper\Project;

use App\Dto\Project\ProjectDto;
use App\Entity\User\Project;
use App\Entity\User\User;
use App\Mapper\Project\ProjectMapper;
use App\Tests\Unit\UnitTestCase;

class ProjectMapperTest extends UnitTestCase
{
    public function testMapToDto(): void
    {
        $user = (new User())
            ->setEmail('email')
            ->setPassword('pass')
        ;

        $project = (new Project())
            ->setName('Проект 1')
            ->addUser($user)
        ;

        $dto = ProjectMapper::mapToDto($project);

        $this->assertEquals('Проект 1', $dto->getName());
    }

    public function testMapToEntity(): void
    {
        $projectDto = (new ProjectDto())
            ->setName('Проект 1')
        ;

        $entity = ProjectMapper::mapToEntity($projectDto);

        $this->assertEquals('Проект 1', $entity->getName());
    }
}
