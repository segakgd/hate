<?php

namespace App\Tests\Functional\Trait\Project;

use App\Entity\ProjectEntity;
use App\Entity\User\User;
use Doctrine\Persistence\ObjectManager;

trait ProjectTrait
{
    public function createProject(ObjectManager $manager, User $user): ProjectEntity
    {
        $project = (new ProjectEntity())
            ->setName('TestName')
            ->addUser($user)
        ;

        $manager->persist($project);
        $manager->flush($project);

        return $project;
    }
}