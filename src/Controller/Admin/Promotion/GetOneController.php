<?php

namespace App\Controller\Admin\Promotion;

use App\Entity\ProjectEntity;
use App\Service\Ecommerce\PromotionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

class GetOneController extends AbstractController
{
    public function __construct(
        private readonly PromotionServiceInterface $promotionService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/promotion/{promotionId}/', name: 'admin_promotion_get_one', methods: ['GET'])]
    #[IsGranted('existUser', 'project')]
    public function execute(ProjectEntity $project, int $promotionId): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->normalize(
                $this->promotionService->getOne($project->getId(), $promotionId),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
