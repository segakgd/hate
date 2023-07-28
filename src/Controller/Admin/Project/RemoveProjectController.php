<?php

namespace App\Controller\Admin\Project;

use App\Entity\ProjectEntity;
use App\Service\Project\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RemoveProjectController extends AbstractController
{
    public function __construct(
        private readonly ProjectService $projectService,
    ) {}

    #[Route('/api/admin/projects/{project}/', name: 'project_remove', methods: ['DELETE'])]
    #[IsGranted('existUser', 'project')]
    public function execute(ProjectEntity $project): JsonResponse
    {
        $this->projectService->removeProject($project->getId());

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
