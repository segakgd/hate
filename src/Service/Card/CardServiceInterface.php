<?php

namespace App\Service\Card;

use App\Dto\CartDto;

interface CardServiceInterface
{
    public function recalculate(CartDto $cartDto): CartDto;
}
