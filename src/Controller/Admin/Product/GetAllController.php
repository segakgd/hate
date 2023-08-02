<?php

namespace App\Controller\Admin\Product;

use App\Entity\ProjectEntity;
use App\Service\Ecommerce\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

class GetAllController extends AbstractController
{
    public function __construct(
        private readonly ProductServiceInterface $productService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/product/', name: 'product_get_all', methods: ['GET'])]
    #[IsGranted('existUser', 'project')]
    public function execute(ProjectEntity $project): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->normalize(
                $this->productService->getAll($project->getId()),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
