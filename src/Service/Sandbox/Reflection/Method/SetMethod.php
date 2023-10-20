<?php

namespace App\Service\Sandbox\Reflection\Method;

class SetMethod
{
    public function __construct(
        private string $var,
        private array $arg = [],
    ) {
    }

    public function apply(object $targetObject): void
    {
        $var = $this->var;

        if (!empty($this->arg[0])){
            $targetObject->$var = $this->arg[0];
        }
    }
}