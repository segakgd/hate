<?php

namespace App\Controller\Admin\Deal;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetDealController extends AbstractController
{
    #[Route('/api/admin/deal/{dealId}/', name: 'deal_get_one', methods: ['GET'])]
    public function execute(int $dealId): JsonResponse
    {
        return new JsonResponse();
    }
}