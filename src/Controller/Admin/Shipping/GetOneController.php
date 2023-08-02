<?php

namespace App\Controller\Admin\Shipping;

use App\Entity\ProjectEntity;
use App\Service\Ecommerce\ShippingServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

class GetOneController extends AbstractController
{
    public function __construct(
        private readonly ShippingServiceInterface $shippingService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/shipping/{shippingId}/', name: 'admin_shipping_get_one', methods: ['GET'])]
    #[IsGranted('existUser', 'project')]
    public function execute(ProjectEntity $project, int $shippingId): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->normalize(
                $this->shippingService->getOne($project->getId(), $shippingId),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
