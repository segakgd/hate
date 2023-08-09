<?php

namespace App\Tests\Functional\Trait;

use App\Entity\Ecommerce\ProductEntity;
use App\Entity\ProjectEntity;
use Doctrine\Persistence\ObjectManager;

trait ProductTrait
{
    public function createProduct(
        ObjectManager $manager,
        ProjectEntity $project,
        array $price,
    ): ProductEntity {
        $entity = (new ProductEntity())
            ->setProject($project->getId())
            ->setName('Name ' . uniqid())
            ->setPrice($price)
            ->setImage('')
        ;

        $manager->persist($entity);
        $manager->flush($entity);

        return $entity;
    }
}