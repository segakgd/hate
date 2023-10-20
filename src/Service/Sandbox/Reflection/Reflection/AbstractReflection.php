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

    public function map(string $json)
    {
        $data = $this->decode($json);

        if (!$data){
            return null;
        }

        foreach ($data as $dataKey => $dataValue){
            $this->$dataKey = $dataValue;
        }
    }

    public function decode($string): ?array
    {
        $decodeJson = json_decode($string, true);

        if (json_last_error() === JSON_ERROR_NONE){
            return $decodeJson;
        }

        return null;
    }
}
