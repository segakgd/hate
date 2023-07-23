<?php

namespace App\Controller\Admin\Deal;

use App\Service\Ecommerce\DealServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetAllDealController extends AbstractController
{
    public function __construct(
        private readonly DealServiceInterface $dealService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/deal/', name: 'deal_get_all', methods: ['GET'])]
    public function execute(int $project): JsonResponse
    {
        // todo нужно искать project

        return new JsonResponse(
            $this->serializer->normalize(
                $this->dealService->getDeals($project),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
