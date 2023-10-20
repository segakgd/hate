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
        'Proxies\__CG__\App\Entity\Lead\DealContacts' => DealContactsReflection::class,
    ];

    /**
     * @throws UndefinedReflectionException
     */
    public function find(string $name, $id): ReflectionInterface
    {
        /** @var Deal $entity */
        $entity = $this->entityManager->find($name, $id);

//        dd($entity->getContacts());
//
//        foreach ($entity->getContacts() as $ggg){
//            dd('asd', $ggg, $entity->getContacts()->getEmail());
//        }
//
//        dd('asd');
//        dd($entity->getContacts());
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

        $reflection = $this->reflectProperties($phpReflectionObject, $reflection, $object);

        return $reflection;
    }

    private function reflectProperties($phpReflectionObject, $reflection, $object)
    {
        $props = $phpReflectionObject->getProperties();

        foreach ($props as $prop) {
            $value = $prop->getValue($object);


//            if (is_iterable($value)){
//                dd($value, $value[0], $value, 'asd');
//                foreach ($value as $val){
//                    $d = $this->reflect($val);
//                    dd($d);
//                }
//
//
////                dd($value);
////                dd('asd');
//            }

//            if (is_object($value)){
//                if (is_iterable($value)){
//                    dd('asd');
//                }
//                dd($value);

//                $d = $this->reflect($value);
//                dd($d, $value);
//            }

//            dd($prop->getValue($object));
            $reflection->{$prop->getName()} = $value;
        }

        return $reflection;
    }
}