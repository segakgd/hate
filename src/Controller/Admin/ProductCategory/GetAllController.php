<?php

namespace App\Controller\Admin\ProductCategory;

use App\Entity\ProjectEntity;
use App\Service\Ecommerce\ProductCategoryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

class GetAllController extends AbstractController
{
    public function __construct(
        private readonly ProductCategoryServiceInterface $productCategoryService,
        private readonly SerializerInterface $serializer,
    ) {}

    #[Route('/api/admin/project/{project}/productCategory/', name: 'product_category_get_all', methods: ['GET'])]
    #[IsGranted('existUser', 'project')]
    public function execute(ProjectEntity $project): JsonResponse
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
