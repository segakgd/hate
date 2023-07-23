<?php

namespace App\Controller\Admin\Deal;

use App\Service\Ecommerce\DealServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RemoveDealController extends AbstractController
{
    public function __construct(
        private readonly DealServiceInterface $dealService,
    ) {}

    #[Route('/api/admin/project/{project}/deal/{dealId}/', name: 'deal_remove', methods: ['DELETE'])]
    public function execute(int $dealId): JsonResponse
    {
        // todo нужно искать project

        $this->dealService->removeDeal($dealId);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
