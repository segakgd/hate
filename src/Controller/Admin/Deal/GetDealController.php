<?php

namespace App\Controller\Admin\Deal;

use App\Service\Ecommerce\DealServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetDealController extends AbstractController
{
    public function __construct(
        private readonly DealServiceInterface $dealService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/deal/{dealId}/', name: 'deal_get_one', methods: ['GET'])]
    public function execute(int $project, int $dealId): JsonResponse
    {
        // todo нужно искать project ... $project

        return new JsonResponse(
            $this->serializer->normalize(
                $this->dealService->getDeal($dealId),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
