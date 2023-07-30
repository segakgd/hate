<?php

namespace App\Tests\Functional\Trait\Deal;

use App\Entity\Ecommerce\DealEntity;
use App\Entity\ProjectEntity;
use Doctrine\Persistence\ObjectManager;

trait DealTrait
{
    public function createDeal(ObjectManager $manager, ProjectEntity $project): DealEntity
    {
        $deal = (new DealEntity())
            ->setProject($project->getId())
        ;

        $manager->persist($deal);
        $manager->flush($deal);

        return $deal;
    }
}
