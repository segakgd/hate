<?php

namespace App\Controller\Admin\Product;

use App\Entity\ProjectEntity;
use App\Service\Ecommerce\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

class GetOneController extends AbstractController
{
    public function __construct(
        private readonly ProductServiceInterface $productService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/product/{productId}/', name: 'admin_product_get_one', methods: ['GET'])]
    #[IsGranted('existUser', 'project')]
    public function execute(ProjectEntity $project, int $productId): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->normalize(
                $this->productService->getOne($project->getId(), $productId),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
