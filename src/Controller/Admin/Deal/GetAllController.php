<?php

namespace App\Controller\Admin\Deal;

use App\Entity\ProjectEntity;
use App\Service\Ecommerce\DealServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

class GetAllController extends AbstractController
{
    public function __construct(
        private readonly DealServiceInterface $dealService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/deal/', name: 'admin_deal_get_all', methods: ['GET'])]
    #[IsGranted('existUser', 'project')]
    public function execute(ProjectEntity $project): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->normalize(
                $this->dealService->getAll($project->getId()),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
