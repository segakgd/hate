<?php

namespace App\Controller\Admin\Project;

use App\Service\Project\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RemoveProjectController extends AbstractController
{
    public function __construct(
        private readonly ProjectService $projectService,
    ) {}

    #[Route('/api/admin/projects/{projectId}/', name: 'project_remove', methods: ['DELETE'])]
    public function execute(int $projectId): JsonResponse
    {
        $this->projectService->removeProject($projectId);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
