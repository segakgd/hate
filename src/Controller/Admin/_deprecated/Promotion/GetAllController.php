<?php

namespace App\Controller\Admin\_deprecated\Promotion;

use App\Entity\User\Project;
use App\Service\Ecommerce\_deprecated\PromotionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

/** @deprecated временно не смотрим на этот код */
class GetAllController extends AbstractController
{
    public function __construct(
        private readonly PromotionServiceInterface $promotionService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/promotion/', name: 'admin_promotion_get_all', methods: ['GET'])]
    #[IsGranted('existUser', 'project')]
    public function execute(Project $project): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->normalize(
                $this->promotionService->getAll($project->getId()),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
