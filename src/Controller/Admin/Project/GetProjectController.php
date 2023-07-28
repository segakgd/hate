<?php

namespace App\Controller\Admin\Project;

use App\Entity\ProjectEntity;
use App\Service\Project\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

class GetProjectController extends AbstractController
{
    public function __construct(
        private readonly ProjectService $projectService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/projects/{projectId}/', name: 'project_get_one', methods: ['GET'])]
    #[IsGranted('existUser', 'project')]
    public function execute(ProjectEntity $project): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->normalize(
                $this->projectService->getProject($project->getId()),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
