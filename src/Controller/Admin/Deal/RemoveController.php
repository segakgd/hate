<?php

namespace App\Controller\Admin\Deal;

use App\Entity\ProjectEntity;
use App\Service\Ecommerce\DealServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RemoveController extends AbstractController
{
    public function __construct(
        private readonly DealServiceInterface $dealService,
    ) {}

    #[Route('/api/admin/project/{project}/deal/{dealId}/', name: 'admin_deal_remove', methods: ['DELETE'])]
    #[IsGranted('existUser', 'project')]
    public function execute(ProjectEntity $project, int $dealId): JsonResponse
    {
        $this->dealService->remove($project->getId(),  $dealId);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
