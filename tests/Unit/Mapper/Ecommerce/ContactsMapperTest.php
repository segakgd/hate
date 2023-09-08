<?php

namespace App\Tests\Unit\Mapper\Ecommerce;

use App\Dto\Ecommerce\ContactsDto;
use App\Entity\Lead\Contacts;
use App\Service\Mapper\Ecommerce\ContactsMapper;
use App\Tests\Unit\UnitTestCase;
use DateTimeImmutable;
use ReflectionException;

class ContactsMapperTest extends UnitTestCase
{
    /**
     * @throws ReflectionException
     */
    public function testMapToDto(): void
    {
        $createdAt = new DateTimeImmutable();

        $entity = (new Contacts())
            ->setFirstName('Дима')
            ->setLastName('Миколаев')
            ->setEmail('nanana@mypost.com')
            ->setPhone('89990999099')
            ->setCreatedAt($createdAt)
        ;

        $dto = ContactsMapper::mapToDto($entity);

        $this->assertObjectProperties(
            $dto,
            [
                'firstName' => 'Дима',
                'lastName' => 'Миколаев',
                'phone' => '89990999099',
                'email' => 'nanana@mypost.com',
            ]
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMapToEntity(): void
    {
        $dto = (new ContactsDto())
            ->setFirstName('Дима')
            ->setLastName('Миколаев')
            ->setEmail('nanana@mypost.com')
            ->setPhone('89990999099')
        ;

        $entity = ContactsMapper::mapToEntity($dto);

        $this->assertObjectProperties(
            $entity,
            [
                'firstName' => 'Дима',
                'lastName' => 'Миколаев',
                'phone' => '89990999099',
                'email' => 'nanana@mypost.com',
            ]
        );
    }
}