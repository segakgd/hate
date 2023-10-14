<?php

namespace App\Service\Admin\Ecommerce\Deal;

use App\Dto\Ecommerce\FieldDto;
use App\Entity\Lead\DealField;

interface FieldServiceInterface
{
    public function add(FieldDto $dto): DealField;

    public function update(FieldDto $dto): ?DealField;
}
