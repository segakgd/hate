<?php

namespace App\Controller\Admin\Project;

use App\Service\Project\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetProjectController extends AbstractController
{
    public function __construct(
        private readonly ProjectService $projectService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/projects/{projectId}/', name: 'project_get_one', methods: ['GET'])]
    public function execute(int $projectId): JsonResponse
    {
        // todo нужно искать project ... $project

        return new JsonResponse(
            $this->serializer->normalize(
                $this->projectService->getProject($projectId),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
