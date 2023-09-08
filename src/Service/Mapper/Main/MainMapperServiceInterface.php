<?php

namespace App\Service\Mapper\Main;

interface MainMapperServiceInterface
{
    public function mapToDto(object|array $object): object;
}