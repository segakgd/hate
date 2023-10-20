<?php

namespace App\Service\Sandbox\Reflection\Reflection;

use App\Service\Sandbox\Reflection\Method\MethodManager;
use App\Service\Sandbox\ReflectionInterface;

abstract class AbstractReflection implements ReflectionInterface
{
    public function __call(string $name, array $arg = []): mixed
    {
        $method = MethodManager::getMethod($name, $arg);

        return $method?->apply($this);
    }
}
