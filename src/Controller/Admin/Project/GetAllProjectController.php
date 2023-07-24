<?php

namespace App\Controller\Admin\Project;

use App\Entity\User\User;
use App\Service\Project\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetAllProjectController extends AbstractController
{
    public function __construct(
        private readonly ProjectService $projectService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/projects/', name: 'project_get_all', methods: ['GET'])]
    public function execute(): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        return new JsonResponse(
            $this->serializer->normalize(
                $this->projectService->getProjects($user),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
