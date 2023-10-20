<?php

namespace App\Controller\Admin\Deal;

use App\Entity\User\Project;
use App\Service\Admin\Ecommerce\Deal\DealManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

class GetOneController extends AbstractController
{
    public function __construct(
        private DealManagerInterface $dealService,
        private SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/deal/{dealId}/', name: 'admin_deal_get_one', methods: ['GET'])]
    #[IsGranted('existUser', 'project')]
    public function execute(Project $project, int $dealId): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->normalize(
                $this->dealService->getOne($project->getId(), $dealId),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
