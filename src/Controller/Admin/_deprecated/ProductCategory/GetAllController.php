<?php

namespace App\Controller\Admin\_deprecated\ProductCategory;

use App\Entity\User\Project;
use App\Service\Ecommerce\_deprecated\ProductCategoryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

/** @deprecated временно не смотрим на этот код */
class GetAllController extends AbstractController
{
    public function __construct(
        private readonly ProductCategoryServiceInterface $productCategoryService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/productCategory/', name: 'admin_product_category_get_all', methods: ['GET'])]
    #[IsGranted('existUser', 'project')]
    public function execute(Project $project): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->normalize(
                $this->productCategoryService->getAll($project->getId()),
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
