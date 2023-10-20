<?php

namespace App\Service\Sandbox\Reflection\Method;

class GetMethod
{
    public function __construct(
        private string $var,
    ) {
    }

    public function apply(object $targetObject): mixed
    {
        $var = $this->var;

        return $targetObject->$var;
    }
}