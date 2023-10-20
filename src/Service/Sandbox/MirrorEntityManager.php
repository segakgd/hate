<?php

namespace App\Service\Sandbox;

use App\Entity\Lead\Deal;
use App\Entity\Lead\DealContacts;
use App\Entity\Lead\DealField;
use App\Exception\Reflection\UndefinedReflectionException;
use App\Service\Sandbox\Reflection\Reflection\DealContactsReflection;
use App\Service\Sandbox\Reflection\Reflection\DealFieldReflection;
use App\Service\Sandbox\Reflection\Reflection\DealReflection;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use Throwable;

/**
 * Менеджер для создания отражений(reflection) сущностей
 *
 * т.е по типу обычного зеркала, которое даёт отражение какого либо объекта внешнего мира
 */
class MirrorEntityManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    private const REFLECTION_CLASS = [
        DealField::class => DealFieldReflection::class,
        Deal::class => DealReflection::class,
        DealContacts::class => DealContactsReflection::class,
    ];

    /**
     * @throws UndefinedReflectionException
     */
    public function find(string $name, $id): ReflectionInterface
    {
        $entity = $this->entityManager->find($name, $id);

        return $this->reflect($entity);
    }

    /**
     * @throws UndefinedReflectionException
     */
    public function reflect(object $object)
    {
        $reflectionType = self::REFLECTION_CLASS[$object::class] ?? throw new UndefinedReflectionException($object::class);
//        $reflectionType = self::REFLECTION_CLASS[$object::class] ?? null;

        if (!$reflectionType){
            return null;
        }

        $phpReflectionObject = new ReflectionClass($object);
        $reflection = new $reflectionType();

        return $this->reflectProperties($phpReflectionObject, $reflection, $object);
    }

    private function reflectProperties($phpReflectionObject, $reflection, $object)
    {
        $props = $phpReflectionObject->getProperties();

        foreach ($props as $prop) {
            $value = $prop->getValue($object);

            $reflection->{$prop->getName()} = $value;
        }

        return $reflection;
    }

    public function save(string $name, int $id, ReflectionInterface $reflection)
    {
        $entity = $this->entityManager->find($name, $id);

        foreach ($reflection as $dd => $reflectio){
            $ff = 'set' . ucfirst($dd);

            try {
                $entity->$ff($reflectio);
            } catch (Throwable){
                // todo костыль
            }
        }

        $this->entityManager->flush($entity);
        $this->entityManager->persist($entity);
    }
}
