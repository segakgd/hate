<?php

namespace App\Controller\Admin\_deprecated\Shipping;

use App\Entity\ProjectEntity;
use App\Service\Ecommerce\_deprecated\ShippingServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

/** @deprecated временно не смотрим на этот код */
class GetAllController extends AbstractController
{
    public function __construct(
        private readonly ShippingServiceInterface $shippingService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/shipping/', name: 'admin_shipping_get_all', methods: ['GET'])]
    #[IsGranted('existUser', 'project')]
    public function execute(ProjectEntity $project): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->normalize(
                $this->shippingService->getAll($project->getId()),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
